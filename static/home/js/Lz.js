/*Lz框架*/
window.Lz=(function () {
	var Lz=function () {
		
	}
	//点击下拉菜单
	Lz.prototype.slideToggle = function (elm,action) {
	var btn = $(elm),
		box = $(".hover_box");
		if(action=="hover"||action==""||action==null){
			btn.hover(function(){
				var that = $(this);
				function slideDown(){
					that.addClass("current");
					btn.parents().find(box).slideDown(200);
				}
				timer = setTimeout(slideDown,200);
			},function(){
				clearTimeout(timer);
				btn.parents().find(box).slideUp(200);
				$(this).removeClass("current");
			})
		}else if(action=="click"){		
			btn.on("click",function(){
				box = $(this).next(".click_slide");
				if(!$(".click_slide").is(":animated")){
					//$(this).addClass("current");
					box.slideToggle();
					$(document).on("click",function(e){
						var $target = $(e.target);
						if($target.closest(".click_slide").length == 0 && $target.closest(elm).length == 0){
							$(".click_slide").slideUp();
							//$(elm).removeClass("current");	
						};
					})
				}
			})
			$(".click_slide li a").on("click",function(){
				var txt = $(this).text();
				var attrValue = $(this).attr("value");
				$(this).parents(".click_slide").slideUp();
				$(this).parents(".click_slide").siblings(elm).text(txt).attr("value", attrValue);
				return false;
			})				
		}else{
			return false;
		}
	}	
    //搜索输入框热点搜索下拉	
	Lz.prototype.hotSearch = function () {	
        var btn= $(".input_relat");
        btn.on("focus",function(){
            var top = $(this).offset().top;
			var left = $(this).offset().left;
			var height = $(this).innerHeight();			
            $(".hot_search").css({"top":top+height,"left":(108+left+"px")}).slideDown();
        }) 
		$(document).on("click",function(e){
			var $target = $(e.target);
			if($target.closest(".hot_search").length == 0 && $target.closest(".input_relat").length == 0){
				$(".hot_search").slideUp();
			}
		})		
		$(".hot_search li a").on("click",function(e){
			var txt = $(this).text();
			$(this).parents(".hot_search").slideUp();
			btn.val(txt);
			return false;
		})
		$(".close").on("click",function(){
				$(".hot_search").slideUp();
				return false;
		})
        
    }	
// 首页幻灯片 

	Lz.prototype.sliderShow = function () {	
		var box = $(".slider"),
			item = box.find(".pic_list"),
			bar = box.find(".current_bar"),
			prev = box.find(".prev_btn"),
			next = box.find(".next_btn"),
			length = item.length;
			item.eq(0).addClass("active").show().siblings(".pic_list").hide();
			for (var i = length - 1; i >= 0; i--) {
				bar.append("<a href='javascript:void(0)'></a>")
			};
			var current = bar.find("a");
			current.on("click",function(){
				var Aindex = $(this).index();
				$(this).addClass("current").siblings().removeClass("current");
				$(this).parents(box).find(".pic_list").eq(Aindex).addClass("active").fadeIn(1000)
					.siblings(".pic_list").removeClass("active").fadeOut(1000);
				return false;
			})
			bar.find("a").eq(0).addClass("current");
			 /*定义一个定时任务*/
			 function autoplay(){
				var i = 0;
				timer=setInterval(function(){
					 i++;
					  if(i<length){
						$(".current_bar a").eq(i).addClass("current").siblings().removeClass("current");
						item.eq(i).fadeIn(1000).siblings(".pic_list").fadeOut(1000);
					  }else{i=-1;}		
					},3000); 
			 };
			autoplay();	 
			next.on("click",function(){
				var active = $(this).parents(box).find("div.active");
				var activeNb = active.index();
				if(!active.is(":animated")){
					active.removeClass("active").fadeOut(1000)
					if (activeNb == length-1){
						item.eq(0).addClass("active").fadeIn(1000);
						active.removeClass("active").fadeOut(1000);	
						bar.find("a").eq(0).addClass("current").siblings().removeClass("current");
					}else{
						item.eq(activeNb+1).addClass("active").fadeIn(1000)
						active.removeClass("active").fadeOut(1000);	
						bar.find("a").eq(activeNb+1).addClass("current").siblings().removeClass("current");
					}
				}
				return false;
			})
			prev.on("click",function(){
				var active = $(this).parents(box).find("div.active");
				var activeNb = active.index();
				if (!active.is(":animated")){
					if (activeNb == 0){
						item.eq(length-1).addClass("active").fadeIn(1000);
						active.removeClass("active").fadeOut(1000);	
						bar.find("a").eq(length-1).addClass("current").siblings().removeClass("current");
					}else{
						item.eq(activeNb-1).addClass("active").fadeIn(1000);
						active.removeClass("active").fadeOut(1000);	
						bar.find("a").eq(activeNb-1).addClass("current").siblings().removeClass("current");					
					}
				}				
				return false;
			})
			box.hover(
				function(){
					clearInterval(timer);
				},
				function(){
					autoplay();
				}
			)
	}	
	//导航个人信息
	Lz.prototype.personalList = function (elm) {	
		$(elm).on("click",function(){
			var that= $(this),
				box = that.next(".click_box");
			if(!$(".click_box").is(":animated")){
				box.slideToggle("fast");
				that.toggleClass("current");						
				$(document).on("click",function(e){
					var $target = $(e.target);
					if($target.closest(".click_box").length == 0 && $target.closest(elm).length == 0){
						$(".click_box").slideUp();
						$(elm).removeClass("current");	
					};
				})
			}
		})	
	}
	//产品div缩放
	Lz.prototype.hoverDiv = function (elm) {	
		var btn = $(elm),
		    height = btn.height(),
			width = btn.width();		
		btn.hover(function(){
			if(!$(this).is(":animated")){
				$(this).animate({"marginTop":"-10px","marginLeft":"-5px","zIndex":"3","width":width+10+"px","height":height+10+"px"},600)	
				$(this).find(".st_right").animate({"width":"235px"},700)
				$(this).find(".st_left").animate({"width":"240px"},700)
			}
		},function(){
				$(this).animate({"marginTop":"0","marginLeft":"0","zIndex":"3","width":width,"height":height},600)					
				$(this).find(".st_right").animate({"width":"230px"},500)
				$(this).find(".st_left").animate({"width":"235px"},500)
		})
	}	
	//登录框
	Lz.prototype.loginBox = function (elm) {		
		var btn =$(".login_box .submit_bar a");
		btn.on("click",function(){
			if(elm==false){
				$(".login_box_no").fadeIn(400);
			}else{
				$(".login_box_yes").fadeIn(400);
			}
			$(this).parents(".login_box").fadeOut(400);	
			return false;
		})
	}
	//城市选择
	Lz.prototype.setCity = function () {		
		var btn =$(".set_area"),
			setCity = $(".city_box").children("a");
		btn.on("click",function(){
			var top = $(this).offset().top,
				box = $(this).parents().find(".city_box");
				if(!box.is(":animated")){		
					box.slideToggle(400).css("top",top+44+"px");
					$(this).toggleClass("current");
					return false;
				}
				$(document).on("click",function(e){
					var $target = $(e.target);
					if($target.closest(".city_box").length == 0 && $target.closest(".set_area").length == 0){
						$(".city_box").slideUp();
						btn.removeClass("current");
					}
				})			
		})

		setCity.on("click",function(){
			var val = $(this).text(),
				ear = $(this).parents().find(".area");
			if(!$(this).hasClass("active")){
				$(this).addClass("active").siblings().removeClass("active");
				ear.text(val);		
				$(this).parents(".city_box").slideUp(400);
				btn.removeClass("current");
				
			}
		
		})
		
	}	
	//右侧悬浮最小最大化
	Lz.prototype.rightBar = function () {	
		$(".max_min").on("click",function(){
			$(this).siblings(".go_top").slideToggle(400);
			$(this).toggleClass("max_on");
			return false;
		})	
	}
	//下拉弹框
	Lz.prototype.alertBox = function (elm,box) {
		var btn = $(elm),
			box = $(box),
			height = box.height();
			box.css("marginTop","-"+height+"px").hide();
			btn.on("click",function(){
				if(!box.is(":animated")){
					box.show();
					box.animate({"top":"50%","marginTop":"-"+height/2+"px"},600);//显示弹出层	
				}
				$(document).on("click",function(e){
					var $target = $(e.target);
					if($target.closest(box).length == 0){
						box.animate({"top":"0","marginTop":"-"+height+"px"},600);
						return false;
					}
				})				
				return false;
			});
			$(".sure_btn,.alert_close").on("click",function(){
				box.animate({"top":"0","marginTop":"-"+height+"px"},600);
				return false;
			});
			
	}	
	
	Lz.prototype.alertBoxUserDefine = function (box) {
		var alertBox = new Object();
		var boxElement = $(box);
		alertBox.box = boxElement;
		boxElement.css("marginTop","-"+boxElement.height()+"px").hide();
		alertBox.messageTitle = boxElement.find("#message_title");
		alertBox.messageContent = boxElement.find("#message_content");
			
		alertBox.showBox = function(data){
			if(data){
				if(data.messageTitle){
					this.messageTitle.html(data.messageTitle);
				}
				if(data.messageContent){
					this.messageContent.text(data.messageContent);
				}
			}
			if(!this.box.is(":animated")){
				$(".cover").css("height",$(document).height());//给透明背景百分百的高度		
				$(".cover").show();//显示背景
				this.box.animate({"top":"50%","marginTop":"-"+alertBox.box.height/2+"px"},600);//显示弹出层	
				this.box.show();
			}
			$(document).on("click",function(e){
				var $target = $(e.target);
				if($target.closest(alertBox.box).length == 0){
					//alertBox.box.animate({"top":"0","marginTop":"-"+alertBox.box.height+"px"},600);
					$(".cover").hide();//隐藏背景
					alertBox.box.hide();
				}
			});
			
			
			return false;
		};
		
		alertBox.box.find(".alert_close, .confirm_btn").on("click",function(){
			//alertBox.box.animate({"top":"0","marginTop":"-"+alertBox.height+"px"},600);
			$(".cover").hide();//隐藏背景
			alertBox.box.hide();
			return false;
		});
		return alertBox;
	}	
	//消息提示渐现弹框
	Lz.prototype.fadeBox = function (elm,box) {
		var btn = $(elm),
			box = $(box);
			btn.on("click",function(){
				if(!box.is(":animated")){
					box.fadeIn(2000);
				}
				$(document).on("click",function(e){
					var $target = $(e.target);
					if($target.closest(box).length == 0){
						box.fadeOut(400);
						return false;
					}
				})					
				return false;
			});
			$(".confirm_btn,.alert_close").on("click",function(){
				box.fadeOut(400);
				return false;
			});
		
	}	
	//active类的添加(联系方式选择)
	Lz.prototype.active = function (elm,way) {
		$(elm).on(way,function(){
			$(this).addClass("active").siblings().removeClass("active");
		})
	}
	//底部选项卡
	Lz.prototype.footLink = function () {
		$('.tab_bar li').on('click',function(){
			var that =$(this),
				nb = that.index(),
				ct = that.parents(".tab_bar").next('.tab_ct').find(".tab_div");					
				that.addClass("active").siblings().removeClass("active");
				ct.eq(nb).siblings().hide();		
				ct.eq(nb).show();	
				return false;
		})		
	}
	//理财明星明处div缩放
	Lz.prototype.StarHover = function (elm) {	
		var btn = $(elm),
			height = btn.height(),
			width = btn.width();
			btn.hover(function(){
				if(!$(this).is(":animated")){
					$(this).addClass("current");
					$(this).animate({"marginTop":8,"marginRight":-8,"marginLeft":6,"zIndex":"3","width":width+16+"px","height":height+8+"px"},200)	
				}
			},function(){
					$(this).removeClass("current");
					$(this).animate({"marginTop":16,"marginRight":0,"marginLeft":14,"zIndex":"3","width":width,"height":height},600)					
			})
	}	
	//综合评价
	Lz.prototype.commentFun = function(){	
		var btn = $(".comment_btn"),
			box = $(".coment_bar_top");
			btn.on("click",function(){
				var that = $(this),
					index = that.index(),
					width = index*114+14,
					score = index*0.4,			
					parentBox = $(this).parent(box),
					bc = that.siblings(".cbtn_on"),
					poitBox = that.parents(".comment_caty").find(".this_poit"),
					poit = poitBox.find("span"),
					result=Math.round(score*10)/10;
					bc.hide();
					$(this).siblings(".cbtn_on").fadeOut();
					if(!parentBox.is(":animated")&&!index==0){
						parentBox.animate({"width":width},1000,function(){
							bc.css("right","-12px").fadeIn(100);
							poitBox.addClass("has_poit");
						});
					}	
			})		
		}
	//头部悬浮
	Lz.prototype.topFix = function(elm){	
		var element =$(elm);
		var top = element.position().top;
		var pos = element.css("position"); //当前元素距离页面document顶部的距离 
		var menu = element.find(".personal_menus");
			$(window).scroll(function() { //侦听滚动时 
				var scrolls = $(this).scrollTop();
				if(scrolls > top){
						element.css({ //设置css 
									"position":"fixed", //固定定位,即不再跟随滚动 
									"top":"0", //距离页面顶部为0 
									"z-index":"999", //层级
						}).addClass("topScrool");	
						menu.show()				
				}else{
						element.css({ //设置css 
									"position":pos, //固定定位,即不再跟随滚动 
									"top":top //距离页面顶部为0 	
						}).removeClass("topScrool");	
						menu.hide().find(".menu_box").hide().siblings(".menus_btn").removeClass("current");
					}
			})
		}
		//底部悬浮
		Lz.prototype.bottomFix = function(elm){	
			var element =$(elm);
			var top = element.position().top;
			var pos = element.css("position"); //当前元素距离页面document顶部的距离 
			var wHeight = $(window).height();
			var divH = $(elm).height();
				$(window).scroll(function() { //侦听滚动时 
					var scrolls = $(this).scrollTop();
					var bottom = wHeight+scrolls-top-divH;		
					if(bottom < 0){				
						element.css({ //设置css 
									"position":"fixed", //固定定位,即不再跟随滚动 
									"bottom":"0", //距离页面顶部为0 
									"z-index":"999",//层级
									"top":""
						}).addClass("bottomScrool");					
					}else{
						element.css({ //设置css 
									"position":pos, //固定定位,即不再跟随滚动 
									"top":top //距离页面顶部为0 	
						}).removeClass("bottomScrool");	
					}
				})	
			}
		//产品详情页产品轮播
		Lz.prototype.productSlide = function(){	
			var box = $(".product_slide"),
				item = box.find(".slider_box table"),
				prev = box.find(".prev_prdouct"),
				next = box.find(".next_prdouct"),
				length = item.length;
				item.eq(0).addClass("active").show().siblings(".pic_list").hide();
			 /*定义一个定时任务*/
			 function autoplay(){
				var i = 0;
				timer=setInterval(function(){
					 i++;
					  if(i<length){
						item.eq(i).addClass("active").siblings().removeClass("active");
					  }else{i=-1;}		
					},3000); 
			 };
			autoplay();	 
			next.on("click",function(){
				var active = $(this).parents(box).find("table.active");
				var activeNb = active.index();
				if(!active.is(":animated")){
					active.removeClass("active").hide(1000)
					if (activeNb == length-1){
						item.eq(0).addClass("active").siblings().removeClass("active");
					}else{
						item.eq(activeNb+1).addClass("active").siblings().removeClass("active");
					}
				}
				return false;
			})
			prev.on("click",function(){
				var active = $(this).parents(box).find("div.active");
				var activeNb = active.index();
				if (!active.is(":animated")){
					if (activeNb == 0){
						item.eq(length-1).addClass("active").siblings().removeClass("active");
					}else{
						item.eq(activeNb-1).addClass("active").siblings().removeClass("active");
					}
				}				
				return false;
			})
			box.hover(
				function(){
					clearInterval(timer);
				},
				function(){
					autoplay();
				}
			)		
		}		
	
	//内页左侧导航
	Lz.prototype.slideNav = function () {
			var box =$(".slide_nav");
			var tit = box.find("h2");
			var chidA = box.find("li a");
			var hnumb = tit.length;		
				for(i=0;i<hnumb-1;i++){
					if(tit.eq(i).hasClass("active")||tit.eq(i).next("ul").find("a").hasClass("active")){
						tit.eq(i).next("ul").show().siblings("ul").hide();
					}			
				}			
				tit.on("click",function(){
					var that = $(this);
					var ul = that.next("ul");
					if(ul){
						if(ul.is(":hidden")){
							ul.siblings("ul").slideUp("400",function(){
								that.siblings().removeClass("active").find("a").removeClass("active");
							});								
							ul.slideDown("400",function(){
								that.addClass("active");
							});							
						}else{							
							ul.slideUp("400",function(){
								that.removeClass("active");
							})
						}
					}
				})
//				chidA.on("click",function(){
//					$(this).addClass("active").parents("li").siblings().find("a").removeClass("active").parents("ul").siblings("h2").removeClass("active");
//					return false;
//				})
	}		

	//切卡
	Lz.prototype.clickTab = function (elm,cont) {
		$(elm).on('click',function(){
			var nb = $(this).index();
			var $ct = $(this).parent(".tab_bar").next('.tab_ct').find(cont);
			$(this).addClass("active").siblings().removeClass("active");
			$ct.eq(nb).siblings().hide();
			$ct.eq(nb).show();
			return false;
		})
	}
	//select_ui
	Lz.prototype.selectBox = function (elm) {	
		$(elm).on("click",function(){
			var that= $(this),
				box = that.next(".select_box");
			if(!$(".select_box").is(":animated")){
				box.slideToggle("fast");
				that.toggleClass("current");
//				box.find("a").on("click",function(){
//					var val = $(this).text();
//					that.find("span").text(val);
//					box.slideUp();
//					$(elm).removeClass("current");						
//				})						
				$(document).on("click",function(e){
					var $target = $(e.target);
//					if($target.closest(".select_box").length == 0 && $target.closest(elm).length == 0){
					if( $target.closest(elm).length == 0){
						box.slideUp();
						$(elm).removeClass("current");	
					};
				})
			}
		})	
	}
	
	//内页左侧导航
	Lz.prototype.slideEven = function (elm,bt) {
			var box =$(elm);
			var tit = box.find(bt);
			var chidA = box.find("li a");
			var hnumb = tit.length;		
				for(i=0;i<hnumb-1;i++){
						alert(i)
					if(tit.eq(i).hasClass("active")||tit.eq(i).next("ul").find("a").hasClass("active")){
						tit.eq(i).next("ul").show().siblings("ul").hide();
					}			
				}	
				tit.on("click",function(){
					var that = $(this);
					var ul = that.next("ul");
					if(ul){
						if(that.hasClass("active")||that.next("ul").find("a").hasClass("active")){
							ul.slideUp("400",function(){
								that.removeClass("active");
							})

						}else{
							ul.siblings("ul").slideUp("400",function(){
								that.siblings("h2").removeClass("active");
							});							
							ul.slideDown("400",function(){
								that.addClass("active");
							});

						}
					}
				})
	}		
	
	//active类的添加
	Lz.prototype.hoverActive = function (elm) {
		$(elm).on("mouseenter",function(){
			that = $(this);		
			function add(){that.addClass("active");}
			timer= setTimeout(add,200);
		})
		$(elm).on("mouseout",function(){		
			clearTimeout(timer);
			that.removeClass("active");		
		});
	}	
	//消息关闭
	Lz.prototype.closeMsg = function () {
		$(".close_msg").on("click",function(){
			$(this).parents("li").slideUp();	
			return false;
		});
	}	
	var Lz = new Lz();
	return Lz;
})();