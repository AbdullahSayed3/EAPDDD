<?php

function awtTrans($text)
{
    // if (config('app.awt') == true) {
    //     return awtTrans($text);

    // }

    return trans('awt.'.$text);
}
