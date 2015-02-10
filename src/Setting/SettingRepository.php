<?php namespace Anomaly\SettingsModule\Setting;

use Illuminate\Config\Repository;

/**
 * Class SettingRepository
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\SettingsModule\Setting
 */
class SettingRepository
{

    /**
     * The setting model.
     *
     * @var SettingModel
     */
    protected $model;

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * Create a new SettingRepository instance.
     *
     * @param SettingModel $model
     * @param Repository   $config
     */
    public function __construct(SettingModel $model, Repository $config)
    {
        $this->model  = $model;
        $this->config = $config;
    }

    /**
     * Get a setting value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $setting = $this->model->where('key', $key)->find();

        if (!$setting) {
            return $this->config->get($key, $default);
        }

        return $setting->value;
    }
}