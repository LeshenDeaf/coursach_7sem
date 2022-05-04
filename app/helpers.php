<?php

if (!function_exists('clear_extra_spaces')) {
    /**
     * Clears extra spaces and new lines. <br>
     * @param string $text
     * @return string
     */
    function clear_extra_spaces(string $text): string
    {
        return preg_replace(
            '/\t+/', '',
                preg_replace(
                '/\n{2,}|(\r\n){2,}/', "\n\n",
                preg_replace(
                    '/ +/', ' ', $text
                )
            )
        );
    }
}
