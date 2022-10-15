<!--===========================  Footer Wrapper Start ===========================-->

<div class="x_footer_bottom_main_wrapper float_left" style="box-shadow: 0px 1px 10px rgb(209 209 209);">
	<div class="container">
		<div class="row">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="x_footer_bottom_box_wrapper float_left">
					<img src="<?=base_url()?>assets/frontend/images/cabmenewlogo.png" alt="" width="50%">
					<p style="color: #797979;">© 2022 Fineoutput Technology Pvt Ltd. All rights reserved</p>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="x_footer_bottom_box_wrapper_second float_left">
					<h3 style="color: #797979;">Information</h3>
					<ul class="footerlinks">
						<li><a href="<?=base_url()?>"><i class="fa fa-long-arrow-right"></i> &nbsp; Home</a>
						</li>
						<li><a href="about.html"><i class="fa fa-long-arrow-right"></i> &nbsp; About</a>
						</li>
						<li><a href="summary.html"><i class="fa fa-long-arrow-right"></i> &nbsp; Summary</a>
						</li>
						<li><a href="faq.html"><i class="fa fa-long-arrow-right"></i> &nbsp; FAQ's</a>
						</li>

					</ul>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<div class="x_footer_bottom_box_wrapper_second float_left mb-5">
					<h3 style="color: #797979;">Social</h3>
				</div>
				<div class="row fsocialicons ml-1">
					<a href="#"><i class="fa fa-facebook" style="font-size: 25px;"></i></a>
					<a href="#"><i class="fa fa-twitter" style="font-size: 25px;"></i></a>
					<a href="#"><i class="fa fa-instagram" style="font-size: 25px;"></i></a>
					<a href="#"><i class="fa fa-youtube" style="font-size: 25px;"></i></a>
					<a href="#"><i class="fa fa-linkedin" style="font-size: 25px;"></i></a>
				</div>
			</div>

		</div>
	</div>
</div>
<!--===========================  Footer Wrapper End ===========================-->

</body>
<script src="<?=base_url()?>assets/frontend/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
var base_url = "<?=base_url()?>"
</script>
<!-- Alert Notification js -->
<script src="<?=base_url()?>assets/frontend/customJS/notificationMessage.js"></script>
<!-- Login Signup js -->
<script src="<?=base_url()?>assets/frontend/customJS/loginSignup.js"></script>
<!-- // - mixed js  -->
<script src="<?=base_url()?>assets/frontend/customJS/mixed.js"></script>
<script src="<?=base_url()?>assets/frontend/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/frontend/js/modernizr.js"></script>
<script src="<?=base_url()?>assets/frontend/js/select2.min.js"></script>
<script src="<?=base_url()?>assets/frontend/js/jquery.menu-aim.js"></script>
<script src="<?=base_url()?>assets/frontend/js/jquery-ui.js"></script>
<script src="<?=base_url()?>assets/frontend/js/jquery.nice-select.min.js"></script>
<script src="<?=base_url()?>assets/frontend/js/owl.carousel.js"></script>
<script src="<?=base_url()?>assets/frontend/js/own-menu.js"></script>
<script src="<?=base_url()?>assets/frontend/js/jquery.bxslider.min.js"></script>
<script src="<?=base_url()?>assets/frontend/js/jquery.magnific-popup.js"></script>
<script src="<?=base_url()?>assets/frontend/js/xpedia.js"></script>
<!-- scripts js -->
<script src="<?=base_url()?>assets/frontend/js/scripts.js"></script>
<script src="<?=base_url()?>assets/frontend/js/bootstrap-notify.min.js"></script>

<!-- custom js-->
<script>
//================================== NOTIFY  ======================================
$(document).ready(function() {
<?php if (!empty($this->session->flashdata('emessage'))) { ?>
 var fail_message = '<?php echo $this->session->flashdata('emessage')?>';
 loadErrorNotify(fail_message);
<?php  } ?>

<?php  if (!empty($this->session->flashdata('validationemessage'))) {
        $valid_errors = $this->session->flashdata('validationemessage');
        $valid_errors = substr($valid_errors, 0, -1); ?>
loadErrorNotify("<?=$valid_errors?>");
<?php
    } ?>

<?php if (!empty($this->session->flashdata('smessage'))) { ?>
  var succ_message = '<?php echo $this->session->flashdata('smessage');?>';
  loadSuccessNotify(succ_message);
 <?php  } ?>

});
//================================== SUCCESS NOTIFY  ======================================

function loadSuccessNotify(succ_message){
  notifySuccess(succ_message);
}
//================================== FAIL NOTIFY  ======================================
    function loadErrorNotify(message){
       notifyError(message);
    }
//------ onchange on time and date -------
$("#sdsd, #sded").change(function(){
	var sdsd=$('#sdsd').val();
	var sdst=$('#sdst').attr('data-time');
	var sded=$('#sded').val();
	var sdet=$('#sdet').attr('data-time');
	// start date covert ------
	var sd    = new Date(sdsd),
		sdyr      = sd.getFullYear(),
		sdmonth   = sd.getMonth() < 10 ? '0' + sd.getMonth() : sd.getMonth(),
		sdday     = sd.getDate()  < 10 ? '0' + sd.getDate()  : sd.getDate(),
		sdDate = sdyr + '-' + sdmonth + '-' + sdday;
		// end date date covert ------
		var ed    = new Date(sded),
			edyr      = ed.getFullYear(),
			edmonth   = ed.getMonth() < 10 ? '0' + ed.getMonth() : ed.getMonth(),
			edday     = ed.getDate()  < 10 ? '0' + ed.getDate()  : ed.getDate(),
			edDate = edyr + '-' + edmonth + '-' + edday;
			//----- calculate diffrence --------
			console.log('startdate= '+sdDate);
			console.log('starttime= '+sdst);
			console.log('enddate= '+edDate);
			console.log('endtime= '+sdet);

// 	if(sdDate !=''&& sdst !='undefined'&& edDate !=''&& sded !='undefined'){
// 		var	diff  = new Date(edDate - sdDate);
// 		 var days  = diff/1000/60/60/24;
// 		alert(days)
// }
});
function time_change(){
	var sdsd=$('#sdsd').val();
	var sdst=$('#sdst').attr('data-time');
	var sded=$('#sded').val();
	var sdet=$('#sdet').attr('data-time');
	// start date covert ------
	var sd    = new Date(sdsd),
    sdyr      = sd.getFullYear(),
    sdmonth   = sd.getMonth() < 10 ? '0' + sd.getMonth() : sd.getMonth(),
    sdday     = sd.getDate()  < 10 ? '0' + sd.getDate()  : sd.getDate(),
    sdDate = sdyr + '-' + sdmonth + '-' + sdday;
		// end date date covert ------
		var ed    = new Date(sded),
			edyr      = ed.getFullYear(),
			edmonth   = ed.getMonth() < 10 ? '0' + ed.getMonth() : ed.getMonth(),
			edday     = ed.getDate()  < 10 ? '0' + ed.getDate()  : ed.getDate(),
			edDate = edyr + '-' + edmonth + '-' + edday;
			//----- calculate diffrence --------
			console.log('startdate= '+sdDate);
			console.log('starttime= '+sdst);
			console.log('enddate= '+edDate);
			console.log('endtime= '+sdet);

	if((sdDate !='')&& (typeof sdst !== "undefined")&& (edDate !='')&& (typeof sded !== "undefined")){
		var start = new Date(sdDate);
		 var end   = new Date(edDate);
		  var diff= (( new Date(edDate+" " +sdet) - new Date(sdDate+" " +sdst) ) / 1000 / 60 / 60 );
			var days =  diff/24;
			var hours =  diff%24;
			if(hours!=0){
				$('#s_duration').html("Duration: "+days+" day, "+hours+" hours")
			}else{
					$('#s_duration').html("Duration: "+days+" day")
			}
				$('#duration').val(diff);
}
}
//------ set city on load -------
$(document).ready(function () {
var id = localStorage.getItem("city_id");
var name = localStorage.getItem("city_name");
if(id != null){
$('#wc_'+id+'').addClass("city_active");
$('#mc_'+id+'').addClass("city_active");
$('.city_id').val(id);
$('.city_title').html(name);
}

});
//------ set city on click -------
function set_city(obj){
	var id = $(obj).attr('city_id');
	var name = $(obj).attr('name');
localStorage.setItem("city_id", id);
localStorage.setItem("city_name", name);
$(".citieslist").removeClass("city_active");
$('#wc_'+id+'').addClass("city_active");
$('#mc_'+id+'').addClass("city_active");
$('.city_id').val(id);
$('#selectcity').modal('hide');
$('#selectcity2').modal('hide');
$('.city_title').html(name);

}

//------ plan change -----
function planChange(x,y){
$('#ct_'+x).val(y);
}
function change(x) {
	if (x == 1) {
		$('#change').html(
			'<div class="col-md-12 col-12 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;border-right: 1px solid rgb(226, 225, 225);justify-content: space-around;"><div class="form-sec-header" style="height: 50px;"><label class="cal-icon" style="top:11px;left: 10px;"> Start Date	<input type="text" placeholder=" 15 Sep 2022"class="form-control  datepicker clickshow" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;"></label></div>	<div class="timepicker_div" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;"><div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;"><label class="cal-icon" style="top:11px;left: 10px;"> Start Time<input type="text" class="form-control timepicker" placeholder="2:30PM" style="background-color: transparent;border: none;margin-left: 5px; margin-top: -10px; width: 84%;"></div></div></div>'
		);
		$(".datepicker").datepicker();
		$('.timepicker').mdtimepicker();
	}
	if (x == 2) {
		$('#change').html(
			'<div class="col-md-3 col-6 mobileradius"style="z-index: 0;display: flex;height: 55px;padding: 0px;border-right: 1px solid rgb(226, 225, 225);"><div class="form-sec-header" style="height: 50px;"><label class="cal-icon" style="top:11px;left: 10px;"> Start Date <input type="text" placeholder=" 15 Sep 2022" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;"></label></div><div class="timepicker_div form-sec-header"	style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;"><label class="cal-icon" style="top:11px;left: 10px;">TIME<input type="text" class="form-control timepicker"	placeholder="2:30PM"	style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;"></div></div><div class="col-md-3 col-6 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;"><div class="form-sec-header" style="height: 50px;"><label class="cal-icon" style="top:11px;left: 10px;"> End Date<input type="text" placeholder=" 15 Sep 2022" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;"></label></div><div class="timepicker_div form-sec-header"	style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">	<label class="cal-icon" style="top:11px;left: 10px;">TIME	<input type="text" class="form-control timepicker"	placeholder="2:30PM"	style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">	</div></div>'
		)
		$(".datepicker").datepicker();
		$('.timepicker').mdtimepicker();

	}
	if (x == 3) {
		$("#change2").html(
			'<div class="col-md-12" style="z-index: 0;display: flex;height: 55px;border: 1px solid rgb(212, 208, 208);padding: 0px;justify-content: space-around;"><div class="form-sec-header" style="height: 50px;">	<label class="cal-icon" style="margin-top: 10px;margin-left: 10px;">Start Date <input type="text" placeholder="15 Sep 2022"	class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;"></label></div><div class="timepicker_div form-sec-headers" style="height: 50px;width: 90px;"><label class="cal-icon"	style="margin-left: 10px;color: #000;font-size: 11px;font-weight: bold;">START TIME<input type="text" class="form-control timepicker" placeholder="2:30PM" style="padding: 23px 0px;background-color: transparent;border: none;width: 84%;margin-top: -12px;"></label></div></div>'
		);
		$(".datepicker").datepicker();
		$('.timepicker').mdtimepicker();

	}
	if (x == 4) {
		$("#change2").html(
			'<div class="col-md-6 "	style="z-index: 0;display: flex;height: 55px;border: 1px solid rgb(212, 208, 208);padding: 0px;"><div class="form-sec-header" style="height: 50px;">	<label class="cal-icon"	style="margin-top: 10px;margin-left: 10px;">Start Date	<input type="text" placeholder="15 Sep 2022"	class="form-control datepicker"	style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">	</label></div><div class="timepicker_div form-sec-headers"	style="height: 50px;width: 90px;"><label class="cal-icon"	style="margin-left: 10px;font-size: 11px;color: #000;font-weight: bold;">TIME<input type="text" class="form-control timepicker"	placeholder="2:30PM"	style="padding: 23px 0px;background-color: transparent;border: none;width: 84%;margin-top: -11px;"></label></div></div><div class="col-md-6 "	style="z-index: 0;display: flex;height: 55px;border: 1px solid rgb(212, 208, 208);padding: 0px;">	<div class="form-sec-header" style="height: 50px;"><label class="cal-icon"	style="margin-top: 10px;margin-left: 10px;">End Date	<input type="text" placeholder="15 Sep 2022"	class="form-control datepicker"	style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;"></label></div><div class="timepicker_div form-sec-headers" style="height: 50px;width: 90px;"><label class="cal-icon"	style="margin-left: 10px;font-size: 11px;color: #000;font-weight: bold;">TIME<input type="text" class="form-control timepicker"	placeholder="2:30PM"	style="padding: 23px 0px;background-color: transparent;border: none;width: 84%;margin-top: -11px;"></label></div></div>'
		);
		$(".datepicker").datepicker();
		$('.timepicker').mdtimepicker();
	}
	if (x == 3) {
		$('#location').html(
			'<div class="col-md-6 mb-3"><div class="x_slider_select x_slider_select_2">	<select class="myselect" style="border-radius: 10px;border: solid 1px #e8e8e8;">	<option>Pickup Location</option>	<option>Jaipur</option><option>Delhi</option><option>Mumbai</option></select> <i class="fa fa-map-marker"></i></div></div><div class="col-md-6  mb-3"><div class="x_slider_select x_slider_select_2" style="margin-left: 12px;">	<select class="myselect" style="border-radius: 10px;border: solid 1px #e8e8e8;">	<option>Drop Location</option>	<option>Bangalore</option>	<option>Chennai</option>	<option>Goa</option></select> <i class="fa fa-map-marker"></i></div></div>'
			)
	} if(x == 4) {
		$("#location").html(
			'<div class="col-md-12 mb-3"><div class="x_slider_select x_slider_select_2">	<select class="myselect" style="border-radius: 10px;border: solid 1px #e8e8e8;">	<option>Pickup Location</option><option>Jaipur</option>	<option>Delhi</option>	<option>Mumbai</option></select> <i class="fa fa-map-marker"></i></div></div>'
			)
	}
	if(x == 1)
	{
		$('#location2').html('<div class="col-md-6 col-6 p-0"><div class="x_slider_select x_slider_select_2" style="margin-left: -14px;">	<select class="myselect" style="border-radius: 10px;border: solid 1px #e8e8e8;">	<option>Pick-Up Location</option><option>Bangalore</option><option>Chennai</option><option>Goa</option></select> <i class="fa fa-map-marker"></i></div></div><div class="col-md-6 col-6 p-0">	<div class="x_slider_select x_slider_select_2" style="margin-left: 2px;">	<select class="myselect" style="border-radius: 10px;border: solid 1px #e8e8e8;">	<option>Drop Location</option>	<option>Jaipur</option>	<option>Delhi</option>	<option>Mumbai</option></select> <i class="fa fa-map-marker"></i></div></div>')
	}
	else {
		$('#location2').html('<div class="col-md-12 col-12 p-0" style="margin-left:-14px;"><div class="x_slider_select x_slider_select_2">	<select class="myselect" style="border-radius: 10px;border: solid 1px #e8e8e8;">	<option>Pickup Location</option>	<option>Jaipur</option>	<option>Delhi</option>	<option>Mumbai</option>	</select> <i class="fa fa-map-marker"></i></div></div>')
	}
}
</script>
<script>
/* -- DO NOT REMOVE --
 * jQuery MDTimePicker v1.0 plugin
 *
 * @requires jQuery
 * -- DO NOT REMOVE -- */
if ("undefined" == typeof jQuery) throw new Error("MDTimePicker: This plugin requires jQuery"); + function (e) {
	var t = "mdtimepicker",
		i = 120,
		s = 90,
		n = 360,
		r = 30,
		a = 6,
		o = [9, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123],
		c = function (t, i) {
			this.hour = t, this.minute = i, this.format = function (t, i) {
				var s = this,
					n = (t.match(/h/g) || []).length > 1;
				return e.trim(t.replace(/(hh|h|mm|ss|tt|t)/g, function (e) {
					switch (e.toLowerCase()) {
						case "h":
							var t = s.getHour(!0);
							return i && 10 > t ? "0" + t : t;
						case "hh":
							return s.hour < 10 ? "0" + s.hour : s.hour;
						case "mm":
							return s.minute < 10 ? "0" + s.minute : s.minute;
						case "ss":
							return "00";
						case "t":
							return n ? "" : s.getT().toLowerCase();
						case "tt":
							return n ? "" : s.getT()
					}
				}))
			}, this.setHour = function (e) {
				this.hour = e
			}, this.getHour = function (e) {
				return e ? 0 === this.hour || 12 === this.hour ? 12 : this.hour % 12 : this.hour
			}, this.invert = function () {
				"AM" === this.getT() ? this.setHour(this.getHour() + 12) : this.setHour(this.getHour() - 12)
			}, this.setMinutes = function (e) {
				this.minute = e
			}, this.getMinutes = function () {
				return this.minute
			}, this.getT = function () {
				return this.hour < 12 ? "AM" : "PM"
			}
		},
		d = function (t, i) {
			var s = this;
			this.visible = !1, this.activeView = "hours", this.hTimeout = null, this.mTimeout = null, this.input = e(
				t), this.config = i, this.time = new c(0, 0), this.selected = new c(0, 0), this.timepicker = {
				overlay: e('<div class="mdtimepicker hidden"></div>'),
				wrapper: e('<div class="mdtp__wrapper"></div>'),
				timeHolder: {
					wrapper: e('<section class="mdtp__time_holder"></section>'),
					hour: e('<span class="mdtp__time_h">12</span>'),
					dots: e('<span class="mdtp__timedots">:</span>'),
					minute: e('<span class="mdtp__time_m">00</span>'),
					am_pm: e('<span class="mdtp__ampm">AM</span>')
				},
				clockHolder: {
					wrapper: e('<section class="mdtp__clock_holder"></section>'),
					am: e('<span class="mdtp__am">AM</span>'),
					pm: e('<span class="mdtp__pm">PM</span>'),
					clock: {
						wrapper: e('<div class="mdtp__clock"></div>'),
						dot: e('<span class="mdtp__clock_dot"></span>'),
						hours: e('<div class="mdtp__hour_holder"></div>'),
						minutes: e('<div class="mdtp__minute_holder"></div>')
					},
					buttonsHolder: {
						wrapper: e('<div class="mdtp__buttons">'),
						btnOk: e('<span class="mdtp__button ok">Ok</span>'),
						btnCancel: e('<span class="mdtp__button cancel">Cancel</span>')
					}
				}
			};
			var n = s.timepicker;
			if (s.setup(n).appendTo("body"), n.clockHolder.am.click(function () {
					"AM" !== s.selected.getT() && s.setT("am")
				}), n.clockHolder.pm.click(function () {
					"PM" !== s.selected.getT() && s.setT("pm")
				}), n.timeHolder.hour.click(function () {
					"hours" !== s.activeView && s.switchView("hours")
				}), n.timeHolder.minute.click(function () {
					"minutes" !== s.activeView && s.switchView("minutes")
				}), n.clockHolder.buttonsHolder.btnOk.click(function () {
					s.setValue(s.selected);
					var t = s.getFormattedTime();
					s.input.trigger(e.Event("timechanged", {
						time: t.time,
						value: t.value
					}
				)).trigger("onchange"), s.hide()
				time_change()
				}), n.clockHolder.buttonsHolder.btnCancel.click(function () {
					s.hide()
				}), s.input.on("keydown", function (e) {
					return 13 === e.keyCode && s.show(), !(o.indexOf(e.which) < 0 && s.config.readOnly)
				}).on("click", function () {
					s.show()
				}).prop("readonly", s.config.readOnly), "" !== s.input.val()) {
				var r = s.parseTime(s.input.val(), s.config.format);
				s.setValue(r)
			} else {
				var r = s.getSystemTime();
				s.time = new c(r.hour, r.minute)
			}
			s.resetSelected(), s.switchView(s.activeView)
		};
	d.prototype = {
		constructor: d,
		setup: function (t) {
			if ("undefined" == typeof t) throw new Error("Expecting a value.");
			var o = this,
				c = t.overlay,
				d = t.wrapper,
				u = t.timeHolder,
				m = t.clockHolder;
			u.wrapper.append(u.hour).append(u.dots).append(u.minute).append(u.am_pm).appendTo(d);
			for (var l = 0; 12 > l; l++) {
				var p = l + 1,
					h = (i + l * r) % n,
					f = e('<div class="mdtp__digit rotate-' + h + '" data-hour="' + p + '"><span>' + p +
						"</span></div>");
				f.find("span").click(function () {
					var t = parseInt(e(this).parent().data("hour")),
						i = o.selected.getT(),
						s = (t + ("PM" === i && 12 > t || "AM" === i && 12 === t ? 12 : 0)) % 24;
					o.setHour(s), o.switchView("minutes")
				}), m.clock.hours.append(f)
			}
			for (var l = 0; 60 > l; l+= 30) {
				var v = 10 > l ? "0" + l : l,
					h = (s + l * a) % n,
					k = e('<div class="mdtp__digit rotate-' + h + '" data-minute="' + l + '"></div>');
				l % 5 === 0 ? k.addClass("marker").html("<span>" + v + "</span>") : k.html("<span></span>"),
					k
					.find("span").click(function () {
						o.setMinute(e(this).parent().data("minute"))
					}), m.clock.minutes.append(k)
			}
			switch (m.clock.wrapper.append(m.am).append(m.pm).append(m.clock.dot).append(m.clock.hours)
				.append(m.clock.minutes).appendTo(m.wrapper), m.buttonsHolder.wrapper.append(m.buttonsHolder
					.btnCancel).append(m.buttonsHolder.btnOk).appendTo(m.wrapper), m.wrapper.appendTo(d), o
				.config.theme) {
				case "red":
				case "blue":
				case "green":
				case "purple":
				case "indigo":
				case "teal":
					d.attr("data-theme", o.config.theme);
					break;
				default:
					d.attr("data-theme", e.fn.mdtimepicker.defaults.theme)
			}
			return d.appendTo(c), c
		},
		setHour: function (t) {
			if ("undefined" == typeof t) throw new Error("Expecting a value.");
			var i = this;
			this.selected.setHour(t), this.timepicker.timeHolder.hour.text(this.selected.getHour(!0)), this
				.timepicker.clockHolder.clock.hours.children("div").each(function (t, s) {
					var n = e(s),
						r = n.data("hour");
					n[r === i.selected.getHour(!0) ? "addClass" : "removeClass"]("active")
				})
		},
		setMinute: function (t) {
			if ("undefined" == typeof t) throw new Error("Expecting a value.");
			this.selected.setMinutes(t), this.timepicker.timeHolder.minute.text(10 > t ? "0" + t : t), this
				.timepicker.clockHolder.clock.minutes.children("div").each(function (i, s) {
					var n = e(s),
						r = n.data("minute");
					n[r === t ? "addClass" : "removeClass"]("active")
				})
		},
		setT: function (e) {
			if ("undefined" == typeof e) throw new Error("Expecting a value.");
			this.selected.getT() !== e.toUpperCase() && this.selected.invert();
			var t = this.selected.getT();
			this.timepicker.timeHolder.am_pm.text(t), this.timepicker.clockHolder.am["AM" === t ?
				"addClass" :
				"removeClass"]("active"), this.timepicker.clockHolder.pm["PM" === t ? "addClass" :
				"removeClass"]("active")
		},
		setValue: function (e) {
			if ("undefined" == typeof e) throw new Error("Expecting a value.");
			var t = "string" == typeof e ? this.parseTime(e, this.config.format) : e;
			this.time = new c(t.hour, t.minute);
			var i = this.getFormattedTime();
			this.input.val(i.value).attr("data-time", i.time).attr("value", i.value)
		},
		resetSelected: function () {
			this.setHour(this.time.hour), this.setMinute(this.time.minute), this.setT(this.time.getT())
		},
		getFormattedTime: function () {
			var e = this.time.format(this.config.timeFormat, !1),
				t = this.time.format(this.config.format, this.config.hourPadding);
			return {
				time: e,
				value: t
			}
		},
		getSystemTime: function () {
			var e = new Date;
			return new c(e.getHours(), e.getMinutes())
		},
		parseTime: function (e, t) {
			var i = this,
				s = "undefined" == typeof t ? i.config.format : t,
				n = (s.match(/h/g) || []).length,
				r = n > 1,
				a = ((s.match(/m/g) || []).length, (s.match(/t/g) || []).length),
				o = e.length,
				d = s.indexOf("h"),
				u = s.lastIndexOf("h"),
				m = "",
				l = "",
				p = "";
			if (i.config.hourPadding || r) m = e.substr(d, 2);
			else {
				var h = s.substring(d - 1, d),
					f = s.substring(u + 1, u + 2);
				m = u === s.length - 1 ? e.substring(e.indexOf(h, d - 1) + 1, o) : 0 === d ? e.substring(0, e
					.indexOf(f, d)) : e.substring(e.indexOf(h, d - 1) + 1, e.indexOf(f, d + 1))
			}
			s = s.replace(/(hh|h)/g, m);
			var v = s.indexOf("m"),
				k = s.lastIndexOf("m"),
				g = s.indexOf("t"),
				w = s.substring(v - 1, v);
			s.substring(k + 1, k + 2);
			l = k === s.length - 1 ? e.substring(e.indexOf(w, v - 1) + 1, o) : 0 === v ? e.substring(0, 2) :
				e
				.substr(v, 2), p = r ? parseInt(m) > 11 ? a > 1 ? "PM" : "pm" : a > 1 ? "AM" : "am" : e
				.substr(g, 2);
			var H = "pm" === p.toLowerCase(),
				_ = new c(parseInt(m), parseInt(l));
			return (H && parseInt(m) < 12 || !H && 12 === parseInt(m)) && _.invert(), _
		},
		switchView: function (e) {
			var t = this,
				i = this.timepicker,
				s = 350;
			"hours" !== e && "minutes" !== e || (t.activeView = e, i.timeHolder.hour["hours" === e ?
					"addClass" : "removeClass"]("active"), i.timeHolder.minute["hours" === e ?
					"removeClass" : "addClass"]("active"), i.clockHolder.clock.hours.addClass("animate"),
				"hours" === e && i.clockHolder.clock.hours.removeClass("hidden"), clearTimeout(t
					.hTimeout), t.hTimeout = setTimeout(function () {
					"hours" !== e && i.clockHolder.clock.hours.addClass("hidden"), i.clockHolder
						.clock
						.hours.removeClass("animate")
				}, "hours" === e ? 20 : s), i.clockHolder.clock.minutes.addClass("animate"),
				"minutes" ===
				e && i.clockHolder.clock.minutes.removeClass("hidden"), clearTimeout(t.mTimeout), t
				.mTimeout = setTimeout(function () {
					"minutes" !== e && i.clockHolder.clock.minutes.addClass("hidden"), i.clockHolder
						.clock.minutes.removeClass("animate")
				}, "minutes" === e ? 20 : s))
		},
		show: function () {
			var t = this;
			if ("" === t.input.val()) {
				var i = t.getSystemTime();
				this.time = new c(i.hour, i.minute)
			}
			t.resetSelected(), e("body").attr("mdtimepicker-display", "on"), t.timepicker.wrapper.addClass(
				"animate"), t.timepicker.overlay.removeClass("hidden").addClass("animate"), setTimeout(
				function () {
					t.timepicker.overlay.removeClass("animate"), t.timepicker.wrapper.removeClass(
						"animate"), t.visible = !0, t.input.blur()
				}, 10)
		},
		hide: function () {
			var t = this;
			t.timepicker.overlay.addClass("animate"), t.timepicker.wrapper.addClass("animate"), setTimeout(
				function () {
					t.switchView("hours"), t.timepicker.overlay.addClass("hidden").removeClass(
							"animate"),
						t.timepicker.wrapper.removeClass("animate"), e("body").removeAttr(
							"mdtimepicker-display"), t.visible = !1, t.input.focus()
				}, 300)
		},
		destroy: function () {
			var e = this;
			e.input.removeData(t).unbind("keydown").unbind("click").removeProp("readonly"), e.timepicker
				.overlay.remove()
		}
	}, e.fn.mdtimepicker = function (i) {
		return e(this).each(function () {
			var s = this,
				n = e(this),
				r = e(this).data(t);
			options = e.extend({}, e.fn.mdtimepicker.defaults, n.data(), "object" == typeof i && i), r ||
				n.data(t, r = new d(s, options)), "string" == typeof i && r[i](), e(document).on(
					"keydown",
					function (e) {
						27 === e.keyCode && r.visible && r.hide()
					})
		})
	}, e.fn.mdtimepicker.defaults = {
		timeFormat: "hh:mm:ss",
		format: "h:mm tt",
		theme: "blue",
		readOnly: !0,
		hourPadding: !1
	}
}(jQuery);
</script>
<script>
$(document).ready(function () {
	$('.timepicker').mdtimepicker();
});

function myFunction() {
	/* Get the text field */
	var copyText = $('#textcopy').html();
	/* Copy the text inside the text field */
	navigator.clipboard.writeText(copyText);
}
</script>




</html>
