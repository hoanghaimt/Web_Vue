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
	                <p class="title">Thông báo booking tại <br>DICHOBIET</p>
	                <p class="text-center">Dưới đây là thông tin về booking chúng tôi nhận được</p>
	                <div class="detail_booking">
	                	<h5 class="text-center">Thông tin chi tiết về booking </h5>
	                	<div class="row">
	                		<table class="table table-bordered">
	                			<tbody>
	                				<tr>
	                					<td>Ngày booking:</td>
	                					<td>{{ date_format(date_create($created_at),'d-m-y H:i:s') }} </td>
	                					
	                					<td>Nngười booking:</td>
	                					<td>{{ $name }}</td>
	                				</tr>
	                				<tr>
	                					<td>Số người tham gia:</td>
	                					<td>{{ $number_of_people }}</td>
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
	                		<li class="col-md-12">Tên hành trình: <i> {{ $tour_name }}</i> </li>
	                		<li class="col-md-12">Địa điểm : {{ $tour_address }}</li>
	                		<li class="col-md-12">Trạng thái Booking : @if($status == 0)
	                													 <span class="text-danger">Đang chờ xét duyệt</span> 
	                													@elseif($status==1)
	                														<span class="text-danger">Đã được duyệt</span>
	                													@else
	                														<span class="text-danger">Đã hủy bỏ</span>
	                													@endif
	                													</li>
	                		@if($status == 2 && $comment !="")
	                			<b class="text-danger">*</b>Lý do : <small class="text-danger"> ({{ $comment }})</small>
	                		@elseif($status==1)
	                			<b class="text-danger">*</b>PS :<small class="text-success"> ({{ $comment }}</small>
	                		@else
	                			<b class="text-danger">*</b>PS :<small class="text-info"> ( Chúng tôi sẽ xét duyệt trong thời gian sớm nhất )</small>
	                		@endif

	                	</div>	                		
	                	<small>Chi tiết về hành trình bạn vui lòng xem </small> 
	                	<a href="{{ url('hanh-trinh/chi-tiet/'.$tour_id.'-'.$tour_slug) }}" class="btn btn-info btn-sm">tại đây</a>
	                </div>
	                <small>Cảm ơn bạn đã Booking hành trình tại DICHOBIET. Chúc bạn có những hành trình thật thú vị!</small>	                
				</div>
			</div>
		</div>
		<footer>
		</footer>
	</body>
</html>