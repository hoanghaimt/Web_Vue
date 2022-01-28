<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<?php $css_File = file_get_contents(asset('public/assets/css/mail.css')); ?>
		<style type="text/css"><?php echo $css_File; ?></style>		
		<style type="text/css" media="screen">
			.text-center {
                text-align: center;
            }
            table {
            	width: 100%;
			    border-collapse: collapse;
			}

			table, th, td {
			    border: 1px solid #ddd;
			    padding: 15px;
			}
			.text-danger{
				color: red;
			}
			.text-success{
				color: #398439;
			}
			.text-info{
				color: #e38d13;
			}
			li{
				font-size: 20px;
			}
		</style>
	</head>
	<body>
		<div class="wrapper_mail">
			<div class="inner_wrapper_mail">
				<div class="content_wrapper_mail">
	                <img class="img_logo" src="{!!asset('public/assets/images/logo-dichobiet@2x.png')!!}" />
	                <p class="title">Thông báo dơn hàng tại <br>TQNPHONEs</p>
	                <p class="text-center">Dưới đây là thông tin về đơn hàng chúng tôi nhận được</p>
	                <div class="detail_booking">
	                	<h5 class="text-center">Thông tin chi tiết về đơn hàng </h5>
	                	<div class="row">
	                		<table class="table table-bordered">
	                			<tbody>
	                				<tr>
	                					<td>Ngày đặt:</td>
	                					<td>{{ date_format(date_create($created_at),'d-m-y H:i:s') }} </td>
	                					
	                					<td>Nngười đặt:</td>
	                					<td>{{ $name }}</td>
	                				</tr>
	                				<tr>
	                					<td>Số sản phẩm:</td>
	                					<td>{{ $qty }}</td>
	                					<td>Địa chỉ:</td>
	                					<td>{{ $address }}</td>
	                				</tr>
	                				<tr>
	                					<td>Tổng chi phí:</td>
	                					<td>{{ formatCurency($total_payment)}}</td>
	                					<td>Điện thoại:</td>
	                					<td>{{ $phone }}</td>
	                				</tr>
	                			</tbody>
	                		</table>
	                		<div class="clearfix"></div>
	                		<hr>
	                		<li class="col-md-12">
	                			Trạng thái đơn hàng : 

	                							@if($status == 0)
												 <span class="text-danger">Đã hủy</span> 
												@elseif($status==1)
													<span class="text-info">Đã nhận</span>
												@elseif($status==2)
													<span class="text-warning">Đang xử lý</span>
												@else
													<span class="text-success">Đã hoàn thành</span>
												@endif
	                		</li>

	                		<b class="text-info">*</b>Ghi chú: <small class="text-danger"> ({{ $comment }})</small>
	        

	                	</div>	                		
	                	<small>Chi tiết về đơn hàng lòng xem </small> 
	                	<a href="#" class="btn btn-info btn-sm">tại đây</a>
	                </div>
	                <small>Cảm ơn bạn đã mua hàng tại TQNPHONEs. Chúc bạn có những trải nghiệm thật thú vị!</small>	                
				</div>
			</div>
		</div>
		<footer>
		</footer>
	</body>
</html>