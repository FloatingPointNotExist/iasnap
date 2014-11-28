

<?php
/**
* 1. �������� �������� ������ ������������.
* 2. ������������ API 2.0 LiqPay ��� �������� �� ������.
*/

/** ��������� ��������� �������� � ���������� �������� (�� $_POST) **/
$amount = 5;
$description = "Posluga";

/** ������� ������������ ����� ��������� �� ������ (��������). **/
echo '<p>
     <b>�����:</b>&nbsp;'. $amount . '&nbsp;$<br />
     <b>���������� �������:</b>&nbsp;' . $description . '<br />
     <b>e-mail:</b>&nbsp;  email  </p>';

/** ����������� ���������� ��� ����� API 2.0 LiqPay **/
$order_id = date("d/m/Y-H:i:s");//id ������
$merchant_id = 'i6289354858'; //ID �������� (����� �������� �� �����/����). �� �� public_key
$private_key = "KvsOs9MOzY2qfE1aYDWu8RxgqnT88UjVSK6WnLZK"; //������� ��������
$return_url = 'https://cnaptest.pp.ua/privat/pay';     //�������� �� ������� �������� ������
$server_url = $return_url; //�������� �� ������� ������� ����� �� �������
$currency = 'UAH'; //������
/*$order_id = array( // ����� ����������� �������� �������, ��� ������� ���������� ���������� ������� (����� �������)
                    0 => date("d/m/Y_H:i:s"), //ID ������� � ����� ��������. ������ ���� ���������� ��� ������� �������.
                    1 => $_POST['SenderMail'], //e-mail ����������. ��������� ��� ������� ����������� � ������� ��� �������.
                    ); //print_r($order_id);
$order_id = implode('~', $order_id); *///����������� ������ � ������
$order_id = "sdsw";
$type = 'buy';//buy - �������, donate - �������������, subscribe - ��������
$sandbox = 0; //��� �����-1, �������-0

/**
* ������� �������.
* ��������!!!
* 1) �������� ������������ �������, ����������� �� https://www.liqpay.com/ru/doc#callback
*    ��� '�������� Callback ���������' ����� �� ��������. ��� �������� ������� - ������ ����������
*    ����������  status (������ ������� ����� ������), transaction_id (Id ������� � ������� LiqPay),
*    sender_phone (����� �������� �����������)
* 2) ����� �� �������� �������� - base64_encode(sha1(...));
*    �� ��������������� ����
*/
$signature = base64_encode(sha1(join('',compact(
     'private_key',
     'amount',
     'currency',
     'merchant_id',
     'order_id',
     'type',
     'description',
     'return_url',
     'server_url'
)),1));

/** ��������� �������� **/
// $signature = base64_encode(sha1(
//          private_key .
//          amount .
//          currency .
//          merchant_id . //public_key .
//          order_id .
//          type .
//          description .
//          return_url .
//          server_url
// ,1));

/** ����� API 2.0 LiqPay **/
echo "1";
echo '<form id="liqpay" method="POST" action="https://www.liqpay.com/api/pay" accept-charset="utf-8">
          <input type="hidden" name="public_key" value="' . $merchant_id . '" />
          <input type="hidden" name="amount" value="' . $amount . '" />
          <input type="hidden" name="currency" value="' . $currency . '" />
          <input type="hidden" name="description" value="' . $description . '" />
          <input type="hidden" name="order_id" value="' . $order_id . '" />
          <input type="hidden" name="result_url" value="' . $return_url . '" />
          <input type="hidden" name="server_url" value="' . $server_url . '" /> 
          <input type="hidden" name="type" value="' . $type . '" />
          <input type="hidden" name="signature" value="' . $signature . '" />
          <input type="hidden" name="language" value="RU" />
          <input type="hidden" name="sandbox" value="' . $sandbox . '" />';
?>
     </form>

     <form id="back" action="javascript:history.back()">
          <!--��� ����� ���������������, ��� �������� �����--></form>

     <!--������ �����-->
          <button type="submit" form="back">�����</button>&nbsp;&nbsp;
     <!--������ ������-->
          <button type="submit" form="liqpay">�������� LiqPay</button>

