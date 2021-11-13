<?php
require_once 'HtmlToDoc.class.php';  

function downloadBill($guest,$idbill,$dateorder,$total) {
    
    $htd = new HtmlToDoc();
    $list=getList($idbill);
    $htmlConTent =
        '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>download</title>
            <style>
                body{
                    color: black;
                    text-align: center;
                }
                .headerShop{
                    font-size: 18px;
                }
                h1{
                    font-size: 35px;
                }
                h2{
                    font-size: 20px;
                }
                table, th, td {
                    border: 1px solid black;
                    border-collapse: collapse;
                }
                th, td {
                    padding: 5px;
                    text-align: left;    
                }
                table.center {
                    margin-left: auto;
                    margin-right: auto;
                }
            </style>
        </head>
        <body>
        <div class="grid wide">
 <div style="text-align:center">
     <p class="headerShop">CỬA HÀNG REROLLACC CHUYÊN CUNG CẤP CÁC SẢN PHẨM LAPTOP</p>
     <h1 style="font-size:35px">HÓA ĐƠN MUA HÀNG</h1>
     <h2 style="font-size:20px">KHÁCH HÀNG: '.$guest['lastname'].' '.$guest['firstname'].'</h2>
     <h3 class="address">Địa chỉ giao hàng: '.$guest['address'].'</h3>

     <div class="row justify-content-center">
         <div class="col-xl-8">
             <table class="table table-bordered table-hover" style="font-size:16px; margin-top:24px">
                 <thead>
                     <tr>
                         <th width="50px">STT</th>
                         <th>Tên Sản phẩm</th>
                         <th width="80px">Số lượng</th>
                         <th >Giá</th>
                     </tr>
                 </thead>
                 <tbody>'.$list.'
                 </tbody>
             </table>
             <div style="font-size:18px; text-align:right; padding-right:15px">Ngày đặt hàng: '.$dateorder.'</div>
             <div style="display:flex;font-size:16px; justify-content: space-between;">
             <p style="font-weight:600">Tổng tiền:  <span style=" color:red; font-weight:bold">'.$total.'</span></p>
             </div>
         </div>
     </div>
 </div>
</div>
        </body>
        </html>';
    
    $htd->createDoc($htmlConTent, 'bill', 1);
    }
    function getList($idbill) 
    {
        $string = '';
        $sql = 'select * from bill where id ='.$idbill;
        $bill = executeResult($sql);

        $index = 1;
        foreach ($bill as $item) {
            $sqlgetprod='select * from product where id ='.$item['idproduct'];
            $product=executeSingleResult($sqlgetprod);
            $total += $item['count']*$product['price'];
            $dateorder=$item['dateorder'];
            $string .= '<tr>
                <td>'.$index++.'</td>
                <td>'.$product['title'].'</td>
                <td>'.$item['count'].'</td>
                <td>'.$product['price'].'</td>
                </tr>';
        }

        return $string;
    }
    ?>