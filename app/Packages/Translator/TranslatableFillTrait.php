<?php namespace Vain\Packages\Translator;

trait TranslatableFillTrait {

    /**
     * name of the locale field
     *
     * @var string
     */
    protected $locale_field = 'locale';

    /**
     * delimiter used to separate from form values
     *
     * @var string
     */
    protected $locale_delimiter = '_';

    /**
     * fills the model with local data
     *
     * @param $locale
     * @param $attributes
     * @return $this
     */
    public function fillTranslated($locale, $attributes)
    {
        $this->{$this->locale_field} = $locale;

        foreach ($this->fillable as $fillable)
        {
            $key = $fillable . $this->locale_delimiter . $locale;

            $value = array_key_exists($key, $attributes)
                ? $attributes[ $key ]
                : null;

            if ($value !== null)
                $this->{$fillable} = $value;
        }

        return $this;
    }
}