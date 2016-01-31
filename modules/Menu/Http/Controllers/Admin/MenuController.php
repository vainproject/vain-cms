<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use LogicException;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Http\Requests\MenuFormRequest;
use Vain\Http\Controllers\Controller;
use Vain\Http\Requests\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::paginate();

        return view('menu::admin.items.index')->with(compact('menus'));
    }

	public function create(Router $router)
	{
        $items = Menu::all();

        $types = [
            Menu::TYPE_ROUTE => trans('menu::menu.type.route'),
            Menu::TYPE_URL => trans('menu::menu.type.extern')
        ];

        $routes = $this->prepareRoutes($router);

        $locales = config('app.locales');

        return view('menu::admin.items.create')->with( compact( 'items', 'types', 'routes', 'locales' ) );
	}

    public function store(MenuFormRequest $request, Router $router)
    {
        Menu::create($this->processInput($request, $router));
    }

	public function edit($id, Router $router)
	{
		$menu = Menu::find($id);

        $items = Menu::all();

        $types = [
            Menu::TYPE_ROUTE => trans('menu::menu.type.route'),
            Menu::TYPE_URL => trans('menu::menu.type.extern')
        ];

        $routes = $this->prepareRoutes($router);

        $locales = config('app.locales');

		return view('menu::admin.items.edit')->with( compact( 'menu', 'items', 'types', 'routes', 'locales' ) );
	}

    public function update($id, MenuFormRequest $request, Router $router)
    {
        Menu::find($id)->fill($this->processInput($request, $router))->save();
    }

    public function destroy($id)
    {
        /** @var Menu $menu */
        $menu = Menu::findOrFail($id);
        $this->authorize('destroy', $menu);

        $menu->delete();
    }

    /**
     * @param Router $router
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
            if ( in_array( 'GET', $route->methods() )
                && $name = $route->getName()) {
                // Store the route in our prepared array
                $routes[$name] = $route->parameterNames();
            }
        }

        return $routes;
    }

    /**
     * @param Request $request
     * @param Router $router
     * @return array
     */
    protected function processInput(Request $request, Router $router)
    {
        $type = $request->input('type');
        $target = $request->input('target.'. $type);
        $params = null;


        if ($type == Menu::TYPE_ROUTE) {
            // If we got a route type we have to do
            // some preprocessing with the input

            // TODO check the target select input so that we do not have to convert it back everytime
            $target = array_keys($this->prepareRoutes($router))[$target];
            if (array_key_exists($target, $parameter = $request->input('parameters'))) {
                // If we found a parameter map to the given route
                // we serialize the input fields and store them
                // inside the database.
                $params = json_encode($parameter[$target]);
            }
        }

        return $request->only(['visible', 'published_at', 'concealed_at']) + [
            'type' => $type,
            'target' => $target,
            'parameters' => $params
        ];
    }
}
