<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/19/2017
 * Time: 3:18 PM
 */
?>
@if(isset($content) && isset($content->shows) && is_array($content->shows))
    @foreach($content->shows as $item)
    @endforeach
@endif
