<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\MenuContent;
use Modules\Menu\Http\Requests\MenuFormRequest;
use Vain\Http\Controllers\Controller;
use Vain\Http\Requests\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menu.item.show', ['only' => ['index', 'show']]);
        $this->middleware('permission:menu.item.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:menu.item.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:menu.item.destroy', ['only' => 'destroy']);
    }

    public function index()
    {
        $menus = Menu::paginate();

        return view('menu::admin.items.index')
            ->with(compact('menus'));
    }

    public function create(Router $router)
    {
        return view('menu::admin.items.create')
            ->with([
                'items'   => $this->prepareParentItems(),
                'types'   => $this->getTypes(),
                'routes'  => $this->prepareRoutes($router),
                'locales' => config('app.locales'),
            ]);
    }

    public function store(MenuFormRequest $request, Router $router)
    {
        /** @var Menu $menu */
        $menu = new Menu($this->processInput($request, $router));
        $menu->save();

        if (!empty($parent_id = $request->input('parent_id'))) {
            $parent = Menu::findOrFail($parent_id);
            $menu->makeChildOf($parent);
        } else {
            $menu->makeRoot();
        }

        foreach (config('app.locales') as $locale => $name) {
            $content = (new MenuContent())
                ->fillTranslated($locale, $request->all());

            $content->menu()->associate($menu);
            $content->save();
        }
    }

    public function edit($id, Router $router)
    {
        $menu = Menu::find($id);

        return view('menu::admin.items.edit')
            ->with([
                'menu'    => $menu,
                'items'   => $this->prepareParentItems(),
                'types'   => $this->getTypes(),
                'routes'  => $this->prepareRoutes($router),
                'locales' => config('app.locales'),
            ]);
    }

    public function update($id, MenuFormRequest $request, Router $router)
    {
        /** @var Menu $menu */
        $menu = Menu::find($id);
        $menu->fill($this->processInput($request, $router));
        $menu->save();

        if (!empty($parent_id = $request->input('parent_id'))) {
            $parent = Menu::findOrFail($parent_id);
            $menu->makeChildOf($parent);
        } else {
            $menu->makeRoot();
        }

        foreach (config('app.locales') as $locale => $name) {
            $content = $menu->contents()
                ->localeOrNew($locale)
                ->fillTranslated($locale, $request->all());

            $content->menu()->associate($menu);
            $content->save();
        }
    }

    public function destroy($id)
    {
        Menu::findOrFail($id)->delete();
    }

    /**
     * @return array
     */
    protected function getTypes()
    {
        return [
            Menu::TYPE_ROUTE => trans('menu::menu.type.route'),
            Menu::TYPE_URL   => trans('menu::menu.type.url'),
        ];
    }

    /**
     * @param Router $router
     *
     * @return array
     */
    protected function prepareRoutes(Router $router)
    {
        $routeCollection = $router->getRoutes();
        $routes = [];

        /** @var Route $route */
        foreach ($routeCollection->getRoutes() as $route) {
            // We mecessarily need a GET Route with a Name
            // other routes are generally unsave to use with
            // the menu module
            if (in_array('GET', $route->methods())
                && $name = $route->getName()) {
                // Store the route in our prepared array
                $routes[$name] = $route->parameterNames();
            }
        }

        return $routes;
    }

    /**
     * @param Request $request
     * @param Router  $router
     *
     * @return array
     */
    protected function processInput(Request $request, Router $router)
    {
        $type = $request->input('type');
        $target = $request->input('target.'.$type);
        $params = null;

        if ($type == Menu::TYPE_ROUTE) {
            // If we got a route type we have to do
            // some preprocessing with the input

            // TODO check the target select input so that we do not have to convert it back everytime
            $target = array_keys($this->prepareRoutes($router))[$target];
            if (array_key_exists($target, $parameter = $request->input('parameters'))) {
                // If we found a parameter map to the given route
                // we store them inside the database.
                $params = $parameter[$target];
            }
        }

        return $request->only(['visible', 'published_at', 'concealed_at']) + [
            'type'       => $type,
            'target'     => $target,
            'parameters' => $params,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function prepareParentItems()
    {
        $items = Menu::with('contents')->get()
            ->lists('depth_title', 'id')
            ->toArray();

        return [null => trans('menu::menu.root')] + $items;
    }
}
