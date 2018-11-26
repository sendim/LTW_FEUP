<?php


    function searchChannels($substring) {
        $channels = get_channels();
        $channelsSub = array();
        foreach($channels as $channel) {
            if (strpos($channel['title'], $substring) !== false) {
                $channelsSub[] = $channel;
            }
        }
        return $channelsSub;
    }

    function searchProfiles($substring) {
        $profiles = get_profiles();
        $profilesSub = array();
        foreach($profiles as $profile) {
            if (strpos($profile['name'], $substring) !== false) {
                $profilesSub[] = $profile;
            }
        }
        return $profilesSub;
    }

    function searchStory($substring) {
        $stories = get_stories();
        $storiesSub = array();
        foreach($stories as $story) {
            if (strpos($story['title'], $substring) !== false) {
                $storiesSub[] = $story;
            }
            else if (strpos($story['text'], $substring) !== false){
                $storiesSub[] = $story;
            }
        }
        return $storiesSub;
    }

    function searchComments($substring) {
        $comments = get_comments();
        $commentsSub = array();
        foreach($comments as $comment) {
            if (strpos($comment['text'], $substring) !== false) {
                $commentsSub[] = $comments;
            }
        }
        return $commentsSub;
    }
    
    function searchBySubstrings($substring, $array) {
        $obj = array();
        foreach($array as $object) {
            if (strpos($object, $substring) !== false) {
                $obj[] = $object;
            }
        }
        return $obj;
    }

?>