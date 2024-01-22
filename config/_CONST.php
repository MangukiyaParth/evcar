<?php
class ProjectConst{
	public $user = "user";
	
	public $admin_role_id = "92212996-3bce-4dc3-9a33-63b6490be21f";
	public $customer_role_id = "17047975-5532-0034-f111-4ba5fb4c4b88";

	public $accgrp_cash = "17014188-3810-8457-6916-12517efd413c";
	public $accgrp_bank = "17014188-1992-5081-a7a4-0a0de65b46bc";
	public $accgrp_purchaseparty = "17014189-3736-2966-6a6e-b6cdda894a8a";
	public $accgrp_purchaseacc = "17014187-3917-1431-0ddf-949265574108";
    
	public $role_cashies = "17021821-3540-5311-9d04-833c63a54b9b";
	public $role_accountant = "17021821-1705-7717-f7f7-491dd7984eca";
	public $role_director = "17021821-2167-4075-dbff-ca1c5d4c4723";
	public $role_sitemanager = "17021821-0124-1421-e5e3-988a7b434c36";
	
	public $sale_type_id = "17051286-8628-1938-aa7f-84adf9b24d11";
	public $salereturn_type_id = "17056398-1907-7905-7382-1e5b1939478e";

	public $max_days_return = 7;
	//Order Status
	public $order_new = 1;
	public $order_conformed = 3;
	public $order_shipped = 6;
	public $order_out_for_delivery = 17;
	public $order_delivered = 7;
	public $order_rto_delivered = 10;
	public $order_pending = 10;

	public $phonepe_payment_return_success = 21;
}