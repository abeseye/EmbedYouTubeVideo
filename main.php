<?php
/*
Plugin Name: YouTube Embed
Plugin URI: 
Description: Embed a YouTube video using just the URL
Version: 1.0
Author: SEA Concepts
Author URI: https://www.seaconcepts.com.ng/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

function youtube_embed_func( $atts ) {
    $atts = shortcode_atts(
        array(
            'url' => '',
        ), $atts, 'youtube' );

    $video_id = get_youtube_video_id($atts['url']);
    if (!$video_id) {
        return "Invalid YouTube URL";
    }

    return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}
add_shortcode( 'youtube', 'youtube_embed_func' );

function get_youtube_video_id($url) {
    $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
    preg_match($pattern, $url, $matches);
    return isset($matches[1]) ? $matches[1] : false;
}
