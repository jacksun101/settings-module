<?php namespace Anomaly\SettingsModule\Setting\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface SettingInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\SettingsModule\SettingInterface\Contract
 */
interface SettingInterface extends EntryInterface
{

    /**
     * Get the key.
     *
     * @return string
     */
    public function getKey();

    /**
     * Set the key.
     *
     * @param $key
     * @return $this
     */
    public function setKey($key);

    /**
     * Get the value.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Set the value.
     *
     * @param $value
     * @return $this
     */
    public function setValue($value);
}
