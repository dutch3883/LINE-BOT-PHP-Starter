<?php
$access_token = 'BcG4dLjmv2bYTUX5arRis6cE/u7Pv5vVVeTy6cJlrzW4b6f6+BVvqpZA0iFPPyaQGW10mkEA8r1ilnd7zQo861qLN8K8SN3/harFGndNPQj1+lzWXjjlu0Aljsv83yjKzorGr7i7J36SjN9KCXFduQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			$userId = $event['source']['userId'];
			
			//Build message to reply back
			// $messages = [
			// 	'type' => 'text',
			// 	'text' => 'replyToken: '.$replyToken
			// ];

			// $messages = [
			// 	'type' => 	'template',
			// 	'altText' =>  'alternative text',
			// 	'template' => [
			// 		'type'	=> 'carousel',
			// 		'columns' => [
			// 			[
			// 				'thumbnailImageUrl' => 'https://www.google.co.th/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png',
			// 				'title' => 'test carousel',
			// 				'text' => 'Select Where to eat today',
			// 				'actions' => [
			// 					[
			// 						'type' => 'postback',
			// 						'label' => 'Kuayteaw',
			// 						'data' => 'response=true&result=1',
			// 						'text' => 'Kuayteaw'
			// 					],
			// 					[
			// 						'type' => 'postback',
			// 						'label' => 'floor 2 parking building',
			// 						'data' => 'response=true&result=2',
			// 						'text' => 'floor 2 parking building'
			// 					]
								
			// 				]
			// 			],
			// 			[
			// 				'thumbnailImageUrl' => 'https://www.google.co.th/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png',
			// 				'title' => 'test carousel',
			// 				'text' => 'Wont eat',
			// 				'actions' => [
			// 					[
			// 						'type' => 'postback',
			// 						'label' => 'drink coffee',
			// 						'data' => 'response=true&result=1',
			// 						'text' => 'drink coffee'
			// 					],
			// 					[
			// 						'type' => 'postback',
			// 						'label' => 'sleep',
			// 						'data' => 'response=true&result=2',
			// 						'text' => 'sleep'
			// 					]
			// 				]
			// 			]
			// 		]
			// 	]
			// ];
			$messages =			{
			  "type": "template",
			  "altText": "this is a carousel template",
			  "template": {
			      "type": "carousel",
			      "columns": [
			          {
			            "thumbnailImageUrl": "https://example.com/bot/images/item1.jpg",
			            "title": "this is menu",
			            "text": "description",
			            "actions": [
			                {
			                    "type": "postback",
			                    "label": "Buy",
			                    "data": "action=buy&itemid=111"
			                },
			                {
			                    "type": "postback",
			                    "label": "Add to cart",
			                    "data": "action=add&itemid=111"
			                },
			                {
			                    "type": "uri",
			                    "label": "View detail",
			                    "uri": "http://example.com/page/111"
			                }
			            ]
			          },
			          {
			            "thumbnailImageUrl": "https://example.com/bot/images/item2.jpg",
			            "title": "this is menu",
			            "text": "description",
			            "actions": [
			                {
			                    "type": "postback",
			                    "label": "Buy",
			                    "data": "action=buy&itemid=222"
			                },
			                {
			                    "type": "postback",
			                    "label": "Add to cart",
			                    "data": "action=add&itemid=222"
			                },
			                {
			                    "type": "uri",
			                    "label": "View detail",
			                    "uri": "http://example.com/page/222"
			                }
			            ]
			          }
			      ]
			  }
			};

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];

			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			

			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "[".$post."]";
echo "OK";