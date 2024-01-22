<?php

// https://stackoverflow.com/questions/9896254/php-class-instance-to-json
class ProjectConst  implements JsonSerializable {
    public function jsonSerialize():mixed {
        return $this;
    }
	public $accgrp_cash = "17014188-3810-8457-6916-12517efd413c";
	public $accgrp_bank = "17014188-1992-5081-a7a4-0a0de65b46bc";
	public $accgrp_purchaseparty = "17014189-3736-2966-6a6e-b6cdda894a8a";
	public $accgrp_purchaseacc = "17014187-3917-1431-0ddf-949265574108";

}