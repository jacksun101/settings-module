<?php namespace Streams\Addon\Module\Settings;

class Settings
{
    /**
     * Loaded settings models.
     *
     * @var array
     */
    protected $models = [];

    /**
     * Get a settings value.
     *
     * @param      $key
     * @param null $default
     * @return null
     */
    public function get($key, $default = null)
    {
        list($namespace, $setting) = explode('::', $key);

        list($type, $addon) = explode('.', $namespace);

        $model = $this->getModel($type, $addon);

        if ($settings = $model->first()) {
            if (strpos($setting, '.') !== false) {
                list($setting, $presenter) = explode('.', $setting);

                $value = $settings->{$setting}->{$presenter};
            } else {
                $value = $settings->{$setting};
            }
        } else {
            $value = $default;
        }

        return $value;
    }

    /**
     * Set the value for a setting.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        list($namespace, $setting) = explode('::', $key);

        list($type, $addon) = explode('.', $namespace);

        $model = $this->getModel($type, $addon);

        if (!$settings = $model->first()) {
            $settings = $model->newInstance();
        }

        $settings->{$setting} = $value;

        return $settings->save();
    }

    /**
     * Return a new settings model per type / addon.
     *
     * @param $type
     * @param $addon
     * @return mixed
     */
    protected function getModel($type, $addon)
    {
        $namespace = 'Streams\Platform\Model\Settings\\';

        $model = $namespace . 'Settings' . studly_case("{$type}_{$addon}") . 'EntryModel';

        if (!isset($this->models[$model])) {
            echo 'New model';
            $this->models[$model] = new $model;
        }

        return $this->models[$model];
    }
} 