<?php
namespace App\Traits;
Trait GeneralTraits{

    static function uploadImageFile($requestName){
        $ext =request()->file($requestName)->getClientOriginalExtension();
        $imageName=time().'.'.$ext;
        $file=request()->file($requestName)->move(public_path('admin/assets/img'),$imageName);
        return $imageName;
    }
    static function uploadProductImage($requestName){
        $img=request()->file($requestName);
        $ext =$img->getClientOriginalExtension();
        $imageName='product-'.rand(1111,99999).'.'.$ext;
        $file=request()->file($requestName)->move(public_path('admin/assets/img/products'),$imageName);
        return $imageName;
    }
    public function getPdfContent($order,$products){
        $content = '';
        $content .= '<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8">
            <title>Example 1</title>
    <style type="text/css" rel="stylesheet" media="all">
            <section>
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
              }

              a {
                color: #5D6975;
                text-decoration: underline;
              }

              body {
                position: relative;
                width: 21cm;
                height: 29.7cm;
                margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 12px;
                font-family: Arial;
              }

              header {
                padding: 10px 0;
                margin-bottom: 30px;
              }

              #logo {
                text-align: center;
                margin-bottom: 10px;
              }

              #logo img {
                width: 90px;
              }

              h1 {
                border-top: 1px solid  #5D6975;
                border-bottom: 1px solid  #5D6975;
                color: #5D6975;
                font-size: 2.4em;
                line-height: 1.4em;
                font-weight: normal;
                text-align: center;
                margin: 0 0 20px 0;
                background: url(dimension.png);
              }

              #project {
                float: left;
              }

              #project span {
                color: #5D6975;
                text-align: right;
                width: 52px;
                margin-right: 10px;
                display: inline-block;
                font-size: 0.8em;
              }

              #company {
                float: right;
                text-align: right;
              }

              #project div,
              #company div {
                white-space: nowrap;
              }

              table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
              }

              table tr:nth-child(2n-1) td {
                background: #F5F5F5;
              }

              table th,
              table td {
                text-align: center;
              }

              table th {
                padding: 5px 20px;
                color: #5D6975;
                border-bottom: 1px solid #C1CED9;
                white-space: nowrap;
                font-weight: normal;
              }

              table .service,
              table .desc {
                text-align: left;
              }

              table td {
                padding: 20px;
                text-align: right;
              }

              table td.service,
              table td.desc {
                vertical-align: top;
              }

              table td.unit,
              table td.qty,
              table td.total {
                font-size: 1.2em;
              }

              table td.grand {
                border-top: 1px solid #5D6975;;
              }

              #notices .notice {
                color: #5D6975;
                font-size: 1.2em;
              }

              footer {
                color: #5D6975;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
              }
            </section>
          </head>
          <body>
            <header class="clearfix">
            
              <h1>INVOICE #000543</h1>
              <div id="company" class="clearfix">
                <div>Mulla Store</div>
                <div>'.$order->state.',<br /> '.$order->town.', '.$order->postal_code.'</div>
                <div>(+20) '.$order->phone.'</div>
                <div><a href="mailto:company@example.com">Laravel@example.com</a></div>
              </div>
              <div id="project">
                <div><span>PROJECT</span> Website development</div>
                <div><span>CLIENT</span> '.$order->name.'</div>
                <div><span>ADDRESS</span> '.$order->address.', '.$order->town.'</div>
                <div><span>EMAIL</span> <a href="mailto:john@example.com">'.$order->email.'</a></div>
                <div><span>DATE</span> '.$order->created_at.'</div>
                <div><span>DUE DATE</span>'.$order->updated_at.'</div>
              </div>
            </header>
            <main>
              <br>
              <br>
              <br>
              <br>
              <table>
                <thead>
                  <tr>
                    <th class="service">PRODUCTS</th>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                  </tr>
                </thead>
                <tbody> ';
                    foreach($products as $product){
                        $content .= '<tr>
                        <td class="service">'.$product->product['product_name'].'</td>
                        <td class="unit">$'.$product->product['final_price'].'</td>
                        <td class="qty">'.$product['product_qty'].'</td>
                        <td class="total">$'.$product['total'].'</td>
                    </tr>';
                        }
                        $content .= '<tr>
                    <td colspan="4">SUBTOTAL</td>
                    <td class="total">$'.$order->total.'</td>
                  </tr>
                  <tr>
                    <td colspan="4">Shipping</td>
                    <td class="total">$0</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="grand total">GRAND TOTAL</td>
                    <td class="grand total">$'.$order->total.'</td>
                  </tr>
                </tbody>
              </table>
              <div id="notices">
                <div>NOTICE:</div>
                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
              </div>
            </main>
            <footer>
              Invoice was created on a computer and is valid without the signature and seal.
            </footer>
          </body>
        </html>';
        return $content;
    }
}
