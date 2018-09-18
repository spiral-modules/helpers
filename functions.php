<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

if (!function_exists('e')) {
    /**
     * Short alias for htmlentities(). This function is identical to htmlspecialchars() in all ways,
     * except with htmlentities(), all characters which have HTML character entity equivalents are
     * translated into these entities.
     *
     * @param mixed $string
     * @param bool  $stripTags
     * @return string
     */
    function e($string = null, bool $stripTags = false): string
    {
        return \Spiral\Helpers\Strings::escape($string, $stripTags);
    }
}

if (!function_exists('interpolate')) {
    /**
     * Interpolate string with given parameters, used by many spiral components.
     *
     * Input: Hello {name}! Good {time}! + ['name' => 'Member', 'time' => 'day']
     * Output: Hello Member! Good Day!
     *
     * @param string $string
     * @param array  $values  Arguments (key => value). Will skip unknown names.
     * @param string $prefix  Placeholder prefix, "{" by default.
     * @param string $postfix Placeholder postfix, "}" by default.
     *
     * @return mixed
     */
    function interpolate(
        string $string,
        array $values,
        string $prefix = '{',
        string $postfix = '}'
    ): string {
        $replaces = [];

        foreach ($values as $key => $value) {
            $value = (is_array($value) || $value instanceof \Closure) ? '' : $value;
            try {
                //Object as string
                $value = is_object($value) ? (string)$value : $value;
            } catch (\Exception $e) {
                $value = '';
            }
            $replaces[$prefix . $key . $postfix] = $value;
        }

        return strtr($string, $replaces);
    }
}