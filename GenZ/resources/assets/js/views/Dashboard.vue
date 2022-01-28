<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="social-box facebook">
          <i class="fa fa-facebook"></i>
          <div class="chart-wrapper">
            <social-box-chart-example :data="[65, 59, 84, 84, 51, 55, 40]" height="90"/>
          </div>
          <ul>
            <li>
              <strong>89k</strong>
              <span>friends</span>
            </li>
            <li>
              <strong>459</strong>
              <span>feeds</span>
            </li>
          </ul>
        </div><!--/.social-box-->
      </div><!--/.col-->
      <div class="col-sm-6 col-lg-3">
        <div class="social-box twitter">
          <i class="fa fa-twitter"></i>
          <div class="chart-wrapper">
            <social-box-chart-example :data="[1, 13, 9, 17, 34, 41, 38]" height="90"/>
          </div>
          <ul>
            <li>
              <strong>973k</strong>
              <span>followers</span>
            </li>
            <li>
              <strong>1.792</strong>
              <span>tweets</span>
            </li>
          </ul>
        </div><!--/.social-box-->
      </div><!--/.col-->
      <div class="col-sm-6 col-lg-3">
        <div class="social-box linkedin">
          <i class="fa fa-linkedin"></i>
          <div class="chart-wrapper">
            <social-box-chart-example :data="[78, 81, 80, 45, 34, 12, 40]" height="90"/>
          </div>
          <ul>
            <li>
              <strong>500+</strong>
              <span>contacts</span>
            </li>
            <li>
              <strong>292</strong>
              <span>feeds</span>
            </li>
          </ul>
        </div><!--/.social-box-->
      </div><!--/.col-->
      <div class="col-sm-6 col-lg-3">
        <div class="social-box google-plus">
          <i class="fa fa-google-plus"></i>
          <div class="chart-wrapper">
            <social-box-chart-example :data="[35, 23, 56, 22, 97, 23, 64]" height="90"/>
          </div>
          <ul>
            <li>
              <strong>894</strong>
              <span>followers</span>
            </li>
            <li>
              <strong>92</strong>
              <span>circles</span>
            </li>
          </ul>
        </div><!--/.social-box-->
      </div><!--/.col-->
    </div><!--/.row-->
    <div class="row">
      <div class="col-md-12">
        <b-card header="Tổng quan bán hàng">
          <div class="row">
            <div class="col-sm-12 col-lg-4">
              <div class="row">
                <div class="col-sm-6">
                  <Callout variant="info">
                    <small class="text-muted">Khách hàng mới</small><br>
                    <strong class="h4">9,123</strong>
                  </Callout>
                </div><!--/.col-->
                <div class="col-sm-6">
                  <Callout variant="danger">
                    <small class="text-muted">Tổng khách hàng</small><br>
                    <strong class="h4">22,643</strong>
                  </Callout>
                </div><!--/.col-->
              </div><!--/.row-->
              <hr class="mt-0">
              <ul class="horizontal-bars">
                <li>
                  <div class="title">
                    Thứ hai
                  </div>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="34" variant="info"></b-progress>
                    <b-progress class="progress-xs" :value="78" variant="danger"></b-progress>
                  </div>
                </li>
                <li>
                  <div class="title">
                    Thứ ba
                  </div>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="56" variant="info"></b-progress>
                    <b-progress class="progress-xs" :value="94" variant="danger"></b-progress>
                  </div>
                </li>
                <li>
                  <div class="title">
                    Thứ tư
                  </div>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="12" variant="info"></b-progress>
                    <b-progress class="progress-xs" :value="67" variant="danger"></b-progress>
                  </div>
                </li>
                <li>
                  <div class="title">
                    Thứ năm
                  </div>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="43" variant="info"></b-progress>
                    <b-progress class="progress-xs" :value="91" variant="danger"></b-progress>
                  </div>
                </li>
                <li>
                  <div class="title">
                    Thứ sáu
                  </div>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="22" variant="info"></b-progress>
                    <b-progress class="progress-xs" :value="73" variant="danger"></b-progress>
                  </div>
                </li>
                <li>
                  <div class="title">
                    Thứ bảy
                  </div>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="53" variant="info"></b-progress>
                    <b-progress class="progress-xs" :value="82" variant="danger"></b-progress>
                  </div>
                </li>
                <li>
                  <div class="title">
                    Chủ nhật
                  </div>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="9" variant="info"></b-progress>
                    <b-progress class="progress-xs" :value="69" variant="danger"></b-progress>
                  </div>
                </li>
                <li class="legend">
                  <span class="badge badge-pill badge-info"></span> <small>Khách hàng mới</small> &nbsp; <span class="badge badge-pill badge-danger"></span> <small>Khách hàn cũ</small>
                </li>
              </ul>
            </div><!--/.col-->
            <div class="col-sm-6 col-lg-4">
              <div class="row">
                <div class="col-sm-6">
                  <Callout variant="warning">
                    <small class="text-muted">Tổng đơn hàng</small><br>
                    <strong class="h4">78,623</strong>
                  </Callout>
                </div><!--/.col-->
                <div class="col-sm-6">
                  <Callout variant="success">
                    <small class="text-muted">Hoàn thành</small><br>
                    <strong class="h4">49,123</strong>
                  </Callout>
                </div><!--/.col-->
              </div><!--/.row-->
              <hr class="mt-0">
              <ul class="horizontal-bars type-2">
                <li>
                  <i class="icon-user"></i>
                  <span class="title">Nam</span>
                  <span class="value">43%</span>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="43" variant="warning"></b-progress>
                  </div>
                </li>
                <li>
                  <i class="icon-user-female"></i>
                  <span class="title">Nữ</span>
                  <span class="value">37%</span>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="37" variant="warning"></b-progress>
                  </div>
                </li>
                <li class="divider"></li>
                <li>
                  <i class="icon-globe"></i>
                  <span class="title">Tìm kiếm bên ngoài</span>
                  <span class="value">191,235 <span class="text-muted small">(56%)</span></span>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="56" variant="success"></b-progress>
                  </div>
                </li>
                <li>
                  <i class="icon-social-facebook"></i>
                  <span class="title">Từ Facebook</span>
                  <span class="value">51,223 <span class="text-muted small">(15%)</span></span>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="15" variant="success"></b-progress>
                  </div>
                </li>
                <li>
                  <i class="icon-social-twitter"></i>
                  <span class="title">Từ Twitter</span>
                  <span class="value">37,564 <span class="text-muted small">(11%)</span></span>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="11" variant="success"></b-progress>
                  </div>
                </li>
                <li>
                  <i class="icon-social-youtube"></i>
                  <span class="title">Từ Youtube</span>
                  <span class="value">27,319 <span class="text-muted small">(8%)</span></span>
                  <div class="bars">
                    <b-progress class="progress-xs" :value="8" variant="success"></b-progress>
                  </div>
                </li>
                <li class="divider text-center">
                  <button type="button" class="btn btn-sm btn-link text-muted"><i class="icon-options"></i></button>
                </li>
              </ul>
            </div><!--/.col-->
            <div class="col-sm-6 col-lg-4">
              <div class="row">
                <div class="col-sm-6">
                  <Callout>
                    <small class="text-muted">Hủy bỏ</small><br>
                    <strong class="h4">23%</strong>
                  </Callout>
                </div><!--/.col-->
                <div class="col-sm-6">
                  <Callout variant="primary">
                    <small class="text-muted">Đỏi trả</small><br>
                    <strong class="h4">5%</strong>
                  </Callout>
                </div><!--/.col-->
              </div><!--/.row-->
              <hr class="mt-0">
              <ul class="icons-list">
                <li>
                  <i class="icon-screen-desktop bg-primary"></i>
                  <div class="desc">
                    <div class="title">iMac 4k</div>
                    <small>Lorem ipsum dolor sit amet</small>
                  </div>
                  <div class="value">
                    <div class="small text-muted">Được bán trong năm</div>
                    <strong>1.924</strong>
                  </div>
                  <div class="actions">
                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i></button>
                  </div>
                </li>
                <li>
                  <i class="icon-screen-smartphone bg-info"></i>
                  <div class="desc">
                    <div class="title">Samsung Galaxy Edge</div>
                    <small>Lorem ipsum dolor sit amet</small>
                  </div>
                  <div class="value">
                    <div class="small text-muted">Được bán trong năm</div>
                    <strong>1.224</strong>
                  </div>
                  <div class="actions">
                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i></button>
                  </div>
                </li>
                <li>
                  <i class="icon-screen-smartphone bg-warning"></i>
                  <div class="desc">
                    <div class="title">iPhone 6S</div>
                    <small>Lorem ipsum dolor sit amet</small>
                  </div>
                  <div class="value">
                    <div class="small text-muted">Được bán trong năm</div>
                    <strong>1.163</strong>
                  </div>
                  <div class="actions">
                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i></button>
                  </div>
                </li>
                <li>
                  <i class="icon-user bg-danger"></i>
                  <div class="desc">
                    <div class="title">Premium accounts</div>
                    <small>Lorem ipsum dolor sit amet</small>
                  </div>
                  <div class="value">
                    <div class="small text-muted">Được bán trong năm</div>
                    <strong>928</strong>
                  </div>
                  <div class="actions">
                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i></button>
                  </div>
                </li>
                <li>
                  <i class="icon-social-spotify bg-success"></i>
                  <div class="desc">
                    <div class="title">Spotify Subscriptions</div>
                    <small>Lorem ipsum dolor sit amet</small>
                  </div>
                  <div class="value">
                    <div class="small text-muted">Được bán trong năm</div>
                    <strong>893</strong>
                  </div>
                  <div class="actions">
                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i></button>
                  </div>
                </li>
                <li>
                  <i class="icon-cloud-download bg-danger"></i>
                  <div class="desc">
                    <div class="title">Ebook</div>
                    <small>Lorem ipsum dolor sit amet</small>
                  </div>
                  <div class="value">
                    <div class="small text-muted">Downloads</div>
                    <strong>121.924</strong>
                  </div>
                  <div class="actions">
                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i></button>
                  </div>
                </li>
                <li>
                  <i class="icon-camera bg-warning"></i>
                  <div class="desc">
                    <div class="title">Photos</div>
                    <small>Lorem ipsum dolor sit amet</small>
                  </div>
                  <div class="value">
                    <div class="small text-muted">Uploaded</div>
                    <strong>12.125</strong>
                  </div>
                  <div class="actions">
                    <button type="button" class="btn btn-link text-muted"><i class="icon-settings"></i></button>
                  </div>
                </li>
                <li class="divider text-center">
                  <button type="button" class="btn btn-sm btn-link text-muted"><i class="icon-options"></i></button>
                </li>
              </ul>
            </div><!--/.col-->
          </div><!--/.row-->
          <br/>
        </b-card>
      </div><!--/.col-->
    </div><!--/.row-->
  </div>
</template>

<script>
import CardLine1ChartExample from './dashboard/CardLine1ChartExample'
import CardLine2ChartExample from './dashboard/CardLine2ChartExample'
import CardLine3ChartExample from './dashboard/CardLine3ChartExample'
import CardBarChartExample from './dashboard/CardBarChartExample'
import MainChartExample from './dashboard/MainChartExample'
import SocialBoxChartExample from './dashboard/SocialBoxChartExample'
import { Callout } from '../components/'

export default {
  name: 'dashboard',
  components: {
    Callout,
    CardLine1ChartExample,
    CardLine2ChartExample,
    CardLine3ChartExample,
    CardBarChartExample,
    MainChartExample,
    SocialBoxChartExample
  },
  data: function () {
    return {
      tableItems: [        
        {
          avatar: { url: '/images/noimg.jpg', status: 'danger' },
          user: { name: 'Friderik Dávid', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'Poland', flag: '/images/noimg.jpg' },
          usage: { value: 43, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Amex', icon: 'fa fa-cc-amex' },
          activity: 'Last week'
        }
      ],
      tableFields: {
        avatar: {
          label: '<i class="icon-people"></i>',
          class: 'text-center'
        },
        user: {
          label: 'User'
        },
        country: {
          label: 'Country',
          class: 'text-center'
        },
        usage: {
          label: 'Usage'
        },
        payment: {
          label: 'Payment method',
          class: 'text-center'
        },
        activity: {
          label: 'Activity'
        }
      }
    }
  },
  mounted(){
    this.loading = false;
  },
  methods: {
    variant (value) {
      let $variant
      if (value <= 25) {
        $variant = 'info'
      } else if (value > 25 && value <= 50) {
        $variant = 'success'
      } else if (value > 50 && value <= 75) {
        $variant = 'warning'
      } else if (value > 75 && value <= 100) {
        $variant = 'danger'
      }
      return $variant
    }
  }
};
</script>
