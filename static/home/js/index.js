// JavaScript Document

function Signfun(n, t) {
	n.append("<span class='zhans'><b>+" + t + "<\/b><\/span>");
	$(".zhans").css({
		position: "absolute",
		"z-index": "1",
		color: "#C30",
		left: 20,
		top: -22
	}).animate({
		top: -40,
		left: 40
	}, "slow", function() {
		$(this).fadeIn("fast").remove()
	})
}
$(function() {
	var n = !1,
		t = !1;
	$("#usersign").click(function() {
		if (n || t) return !1;
		t = !0;	
	    var i = $(this);		
		Signfun(i,10);
		$("#usersign").addClass("icon-btn-mallc").find(".sptxt").text("已签到");
		
	});
	
});

/*function Signfun(n, t) {
	n.append("<span class='zhans'><b>+" + t + "<\/b><\/span>");
	$(".zhans").css({
		position: "absolute",
		"z-index": "1",
		color: "#C30",
		left: 20,
		top: -22
	}).animate({
		top: -40,
		left: 40
	}, "slow", function() {
		$(this).fadeIn("fast").remove()
	})
}
$(function() {
	var n = !1,
		t = !1;
	$("#usersign").click(function() {
		if (n || t) return !1;
		t = !0;
		var i = $(this);
		return $.ajax({
			url: "/User/Home/UserSign",
			type: "POST",
			async: !1,
			dataType: "json",
			success: function(r) {
				r.isSuccess && (r.data = r.data || 0, Signfun(i, r.data), $("#s_integral").text((parseInt($("#s_integral").text()) || 0) + r.data));
				n = !0;
				t = !1;
				$("#usersign").addClass("icon-btn-mallc").find(".sptxt").text("已签到")
			}
		}), !1
	});

});*/
//# sourceMappingURL=index.min.js.map
