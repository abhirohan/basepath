<?php


 $graph_url = "https://graph.facebook.com/v2.9/725737294181555?fields=name%2Cfirst_name%2Clast_name%2Cemail%2Cbirthday%2Cage_range%2Clink%2Cgender%2Clocale%2Cpicture%2Ccover%2Ctimezone%2Cverified&access_token=EAACEdEose0cBABZAuU6OQM2B4TMAs6MYvMkKWZBPI3YUGL8ZAgdcfhYnyrpDkD50qJljBwzOkdwQcQx8NaOiNZCguIN9FSNqykIDP84HuPUudLp5vQMvtpeGAwHCuzIzZC2FdpqoP7w5djuAt81etX8tRmFNAXeMZA91YOsvYFl1POtAeBMTsLgv3qu3ftSpAZD";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $graph_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $output = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($output);
		echo"<pre>"; print_r($data);

?>