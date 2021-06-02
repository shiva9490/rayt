var adminurl    = '/raytt/Rayt-Admin';
var partnerurl    = '/raytt/Partner-Admin';
var formInit    =   function(){
    $(".validform").validate({
        rules: {
            new_password: {
                required: true,
                minlength: 5
            },
            con_password: {
                required: true,
                minlength: 5,
                equalTo: "#new_password"
            },
            widget_display_name:{
                remote:{
                    url:adminurl+"/Ajax-Widget-Check",
                    type:"post",
                    data:{
                        widget_display_name:function(){
                            return  $(".widget_display_name").val();
                        }
                    }
                }
            },
            role_name:{
                remote:{
                    url:adminurl+"/Ajax-Role-Check",
                    type:"post",
                    data:{
                        role_name:function(){
                            return  $(".role_name").val();
                        }
                    }
                }
            },
            user_name:{
                remote:{
                    url:adminurl+"/Ajax-User-Check",
                    type:"post",
                    data:{
                        user_name:function(){
                            return  $(".user_name").val();
                        }
                    }
                }
            },
            user_email:{
                remote:{
                    url:adminurl+"/Ajax-Email-Check",
                    type:"post",
                    data:{
                        user_email:function(){
                            return  $(".user_email").val();
                        }
                    }
                }
            },
            degree_name:{
                remote:{
                    url:adminurl+"/Ajax-Degree-Check",
                    type:"post",
                    data:{
                        degree_name:function(){
                            return  $(".degree_name").val();
                        }
                    }
                }
            },
            idproof_name:{
                remote:{
                    url:adminurl+"/Ajax-Proof-Check",
                    type:"post",
                    data:{
                        idproof_name:function(){
                            return  $(".idproof_name").val();
                        }
                    }
                }
            },
            subject_name:{
                remote:{
                    url:adminurl+"/Ajax-Subject-Check",
                    type:"post",
                    data:{
                        subject_name:function(){
                            return  $(".subject_name").val();
                        }
                    }
                }
            },
            level_name:{
                remote:{
                    url:adminurl+"/Ajax-Level-Check",
                    type:"post",
                    data:{
                        level_name:function(){
                            return  $(".level_name").val();
                        }
                    }
                }
            },
            organization_name:{
                remote:{
                    url:adminurl+"/Ajax-Organization-Check",
                    type:"post",
                    data:{
                        organization_name:function(){
                            return  $(".organization_name").val();
                        }
                    }
                }
            },
            designation_name:{
                remote:{
                    url:adminurl+"/Ajax-Designation-Check",
                    type:"post",
                    data:{
                        designation_name:function(){
                            return  $(".designation_name").val();
                        }
                    }
                }
            }
        },
        messages: {
            role_name: {
                required: 'Role Name is required',
                remote:jQuery.validator.format("<span class='text-success'>{0}</span> : Role Name already exists")
            },
            user_name: {
                required: 'User Name is required',
                remote:jQuery.validator.format("<span class='text-success'>{0}</span> : User Name already exists")
            },
            user_email: {
                required: 'Email Id is required',
                remote:jQuery.validator.format("<span class='text-success'>{0}</span> : Email Id already exists")
            },
            degree_name: {
                required: 'Degree Name is required',
                remote:jQuery.validator.format("<span class='text-success'>{0}</span> : Degree Name already exists")
            },
            idproof_name: {
                required: 'ID Proof is required',
                remote:jQuery.validator.format("<span class='text-success'>{0}</span> : ID Proof already exists")
            },
            subject_name: {
                required: 'Subject Name is required',
                remote:jQuery.validator.format("<span class='text-success'>{0}</span> : Subject Name already exists")
            },
            level_name: {
                required: 'Level Name is required',
                remote:jQuery.validator.format("<span class='text-success'>{0}</span> : Level Name already exists")
            },
            organization_name: {
                required: 'Organization Name is required',
                remote:jQuery.validator.format("<span class='text-success'>{0}</span> : Organization Name already exists")
            },
            designation_name: {
                required: 'Designation Name is required',
                remote:jQuery.validator.format("<span class='text-success'>{0}</span> : Designation Name already exists")
            },
            new_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            con_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            }
        }
    });
};
var initPart    =   function(){
    $(document).find('a[data-type="order"]').each(function () {
        if ($(this).data("field") == $("#tipoOrderby").val()) {
            if ($("#orderby").val() == "ASC") { 
                $("i", this).removeClass('zmdi-sort');
                $(this).data("order", "DESC");
                $("i", this).addClass('zmdi-sort-asc');
            } else {
                $("i", this).removeClass('zmdi-sort');
                $("i", this).addClass('zmdi-sort-desc');
                $(this).data("order", "ASC");
            }
        } else {
            $("i", this).removeClass('zmdi-sort');
            $("i", this).addClass('zmdi-sort-asc');
            $(this).data("order", "ASC");
        } 
    });
}
var input_rest = function(){
        $(".input_num").keypress(function(event){
                var inputValue = event.which;  
                if(!(inputValue >= 48 && inputValue <= 57) && (inputValue != 0 && inputValue != 8) ) { 
                        event.preventDefault(); 
                }
        });
        $(".input_geo").keypress(function(event){
                var inputValue = event.which; 
                if(!(inputValue >= 48 && inputValue <= 57) && (inputValue != 0 && inputValue != 8 &&inputValue != 46)) { 
                        event.preventDefault(); 
                }
        });
        $(".input_char").keypress(function(event){
                $(this).css("text-transform","capitalize");
                var inputValue = event.which;   
                if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 0 && inputValue != 8 && inputValue != 32 && inputValue != 46 &&  inputValue != 0)) { 
					event.preventDefault(); 
                }
        }); 
        $(".upperceaseval").keypress(function(event){
                $(this).css("text-transform","uppercase"); 
        });
        $(".capitalizeval").keypress(function(event){
                $(this).css("text-transform","capitalize"); 
        });
};

function itemslist(url,id){
	var url = $('#urlvalue').val();
	var vale = $('.nav-link').attr('data-valu'+id);
	searchFilter('',url,id);
}
function getdatafiled(event,ids){
        initPart();
        $("#tipoOrderby").val(event.data("field"));
        $("#orderby").val(event.data("order")); 
        $("#vtipoOrderby").val(event.data("field"));
        $("#vorderby").val(event.data("order"));
        var id = ids;//$('.text-center.list-actions.active').attr('data-type');
        $('#category').val(id);
        searchFilter('',event.attr("urlvalue"),'');
}
/*
function menuactive(id){
    $(".nav-link").removeClass("list-actions active");*/
    $(".nav-link").on('click', function (){
        $(".nav-link").removeClass("list-actions active");
        $(this).toggleClass('list-actions active');
    });
//}
function searchFilter(page_num,url,id){
        $('.loader').css('display','block');
        if(id !="undefined"){
           var ids         =   '';
        }else{
            var ids = id;
        }
        page_num        =   page_num?page_num:0; 
        var keywords    =   $('#FilterTextBox').val();
        var secserach   =   $('.secserach option:selected').val();   
        var classserch  =   $('.classserch option:selected').val();   
        var schoolserch =   $('.schoolserch option:selected').val();   
        var limitvalue  =   $('.limitvalue option:selected').val();   
        var vspvalue    =   $("#vspvalue").val();   
        var date        =   $("input[name='date']").val();
        var vspcalss    =   "postList";
        var orders      =   $("#orders").val();
        var topv        =   $("#tipoOrderby").val();
        var orderby     =   $("#orderby").val();
		var category 	= 	$('#category').val();//id;//$('#all-list').attr('all-list'+id);
        var clf         =   "pageloaderwrapper";
        if(vspvalue == 1){
            vspcalss    =   "perpostList";
            keywords    =   $('#vFilterTextBox').val();      
            limitvalue  =   $('.vlimitvalue option:selected').val();   
            topv        =   $("#vtipoOrderby").val();
            orderby     =   $("#vorderby").val();
            clf         =   "pagewrapper";
        }
        $('.'+vspcalss).html(""); 
        $.ajax({
            type    :   'POST',
            url     :   url+page_num,
            data:{
                    tipoOrderby :   topv,
                    orderby     :   orderby,
                    secserach   :   secserach,
                    schoolserch :   schoolserch,
                    classserch  :   classserch,
                    limitvalue  :   limitvalue,
                    keywords    :   keywords,
					category	:	category,
					orders      :   orders,
                    date        :   date,
            },
            beforeSend: function(){
                    $('.'+clf).show();
            }, 
            success: function (html) { 
                    $('.loader').css('display','none');
                    $('.'+clf).hide();
                    $('.'+vspcalss).html(html); 
                    initPart();
            }
        });   
}   
function user_role(){
        var vale = [];
        var modiul   =   [];
        $(".user_roles option:selected").map(function(i, el) {
                vale[i]   =   $(el).val(); 
        }); 
        $(".user_modules option:selected").map(function(fs, els) {
                modiul[fs]   =   $(els).val();
        }); 
        $(".ajaxListPer").html("");
        $('.pageloaderwrapper').show();
        $.post(adminurl+"/AjaxPermission",{vale:vale,modiul:modiul},function(data){
                $(".ajaxListPer").html(data);
                $('.pageloaderwrapper').hide();
        });
}
function master_check(evt){
        var svsp    =   evt.is(":checked");
        var svpp    =   evt.val();
        if(svsp){ 
                $(".check_"+svpp).attr("checked","checked");
        }else{
                $(".check_"+svpp).removeAttr("checked");
        } 
}
function confirmationDelete(anchor, val) {
    /*swal({
            title: "Delete " + val,
            text: "Once deleted, you will not be able to recover this "+val,
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
    }).then(function(willDelete) {
        if (willDelete) {
            var atr     =   anchor.attr("attrvalue");
            $.post(atr,function(data){
                if(data == 1){
                    loadpage();
                }
            });
            swal.close();
        } else {
            swal("Not Deleted any "+val);
        }
    });*/
    swal({
        title: 'Are you sure?',
        text: "Once deleted, you will not be able to recover this "+val,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        padding: '2em'
    }).then(function(result) {
        if (result.value) {
            var atr     =   anchor.attr("attrvalue");
            $.post(atr,function(data){
                if(data == 1){
                    loadpage();
                    location.reload() ;
                    addonslist();
                }
            });
            swal(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
        }
    })
} 
function activeform(evt,page){
    var fields  =   evt.attr("fields");
    var status  =   evt.attr("title");
    /*swal({
        title: "Are you sure you want to " + status,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((isConfirm) => {
        if (isConfirm) { 
            $.post(adminurl+"/"+page,{status:status,fields:fields},function(data){
                if(data == 1){
                    loadpage();
                }else if(data == 0){
                    swal("No permissions ....!!!", '');
                } else {
                    swal("Not updated any ....!!!", '');
                }
            });
            swal.close();
        }
        else {
            swal("Not updated any ....!!!", status);
        }
    });*/
    swal({
        title: 'Are you sure?',
        text: "Are you sure you want to " + status,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        padding: '2em'
    }).then(function(result) {
        if (result.value) {
            $.post(adminurl+"/"+page,{status:status,fields:fields},function(data){
                if(data == 1){
                    loadpage();
                }else if(data == 0){
                    swal("No permissions ....!!!", '');
                } else {
                    swal("Not updated any ....!!!", '');
                }
            });
            swal(
              status,
              'Your file has been '+status,
              'success'
            )
        }else{
            swal("Not updated any ....!!!", status);
        }
    })
}
function loadpage(){
        var urlvalue        =   $("#urlvalue").val();
        var vspvalue        =   $("#vspvalue").val();
        var permiurlvalue   =   $("#permiurlvalue").val();
        if(typeof vspvalue !== "undefined"){
            var perurlvalue   =   $("#perurlvalue").val();
            if(typeof perurlvalue !== "undefined"){
                searchFilter('',perurlvalue);
            }
        }else {
            if(typeof urlvalue !== "undefined"){
                searchFilter('',urlvalue);
            }
            if(typeof permiurlvalue !== "undefined"){
                user_role();
            }
        }
} 
function pageform(){
        $(".pageurl,.pagewidgets,.rightcontent,.contentpage,.leftcontent").hide();
        $(".left_widget,.contet_widget,.right_widget").hide();
        $(".page_url").removeAttr("required");
        var page_layout     =   $(".page_layout option:selected").attr("atrvalue");
        var content_from    =   $('.page_content option:selected').attr("atrvalue");  
        if(content_from == '1'){
                $(".page_layout").removeAttr("required");
                $(".pageurl").show();
                $(".page_url").attr("required","required");
        }
        if(content_from == '2' && page_layout == '1'){
                $(".leftcontent").show(); 
                $(".contentpage").show();
        }
        if(content_from == '2' && page_layout == '2'){
                $(".contentpage").show();
                $(".rightcontent").show(); 
        }
        if(content_from == '2' && page_layout == '3'){
                $(".contentpage").show(); 
        }
        if(content_from == '2' && page_layout == '4'){
                $(".leftcontent").show(); 
                $(".contentpage").show();
                $(".rightcontent").show(); 
        }
        if(content_from == '3'){ 
                $(".pagewidgets").show();
        }
        if(content_from == '3' && page_layout == '1'){ 
                $(".left_widget").removeClass().addClass("left_widget col-md-4").show(); 
                $(".contet_widget").removeClass().addClass("contet_widget col-md-8").show();
                $(".right_widget").removeClass().addClass("right_widget");
                
        }
        if(content_from == '3' && page_layout == '2'){ 
                $(".left_widget").removeClass().addClass("left_widget");
                $(".contet_widget").removeClass().addClass("contet_widget span7 col-md-7").show();
                $(".right_widget").removeClass().addClass("right_widget span4 col-md-4").show(); 
                
        }
        if(content_from == '3' && page_layout == '3'){  
                $(".left_widget").removeClass().addClass("left_widget");
                $(".right_widget").removeClass().addClass("right_widget");
                $(".contet_widget").removeClass().addClass("contet_widget col-md-12").show();
                
        }
        if(content_from == '3' && page_layout == '4'){ 
                $(".left_widget").removeClass().addClass("left_widget col-md-4").show(); 
                $(".contet_widget").removeClass().addClass("contet_widget col-md-4").show();
                $(".right_widget").removeClass().addClass("right_widget col-md-4").show();
                
        }
}
var menudepth    =   function(){
    $('#menu-form .dd').nestable({
        maxDepth:4
    }); 
    $('#menu-form .dd').on('change', function () {
            var data =  [];
            jQuery('.dd-item').each(function(){
                    var id 		= jQuery(this).attr('data-id');
                    var parent  = jQuery(this).parent().parent().attr('data-id');
                    if(typeof parent == 'undefined')
                            parent = 0;
                    var menu = {'id':id,'parent':parent};
                    data.push(menu);
            });
            $(".top_menu").val(JSON.stringify(data)); 
    });
    $('.row_nest .pagewidgets .dd,.row_nest .left_widget .dd,.row_nest .contet_widget .dd,.row_nest .right_widget .dd').nestable({
            maxDepth:1
    });
}
var menuInit    =   function(){  
    $('.row_nest .left_widget .dd').on('change', function () {
            var lefst = []; 
            $('.row_nest .left_widget .dd-item').each(function(){
                    var lid      =   $(this).attr('data-id');  
                    lefst.push(lid);  
            });
            $(".left_contentval").val(lefst.join(","));
    });
    $('.row_nest .contet_widget .dd').on('change', function () {
            var cnt = []; 
            $('.row_nest .contet_widget .dd-item').each(function(){
                    var lid      =   $(this).attr('data-id');  
                    cnt.push(lid);  
            });
            $(".page_conentval").val(cnt.join(",")); 
    });
    $('.row_nest .right_widget .dd').on('change', function () {
             var dcnt = []; 
            $('.row_nest .right_widget .dd-item').each(function(){
                    var lid      =   $(this).attr('data-id');  
                    dcnt.push(lid);  
            });
            $(".right_contentval").val(dcnt.join(",")); 
    });
}
function approveaddcoins(evt){
    var urvlvalue   =   evt.attr("urvlvalue");
    var titleurl    =   evt.attr("titleurl");
    $.post(adminurl+"/"+urvlvalue,function(data){
         $(".lasizemodal .modal-title").html(titleurl);
         $(".lasizemodal .modal-body").html(data);
         $(".lasizemodal").modal("show");
    });
}
function verifyrstatus(evt,pafv){
    var urvlvalue   =   evt.attr("urvlvalue");
    var title       =   evt.attr("ststu"); 
    $.post(adminurl+"/"+urvlvalue,{fields:pafv,title:title},function(data){
        loadpage();
    });
}
$(function(){ 
        //menudepth();
        menuInit();
});
function cusountry(evt){
    evt.autocomplete({
        minLength: 1,
        source: function(request, response ) {  
            $.ajax({
                url: "/Ajax-Country",
                type: "GET",
                data: request,
                success: function (data) {
                    var data    =   $.parseJSON(data);
                    response($.each(data, function (el) {
                        return {
                            label: el.label,
                            value: el.value
                        };
                    }));
                }
            }); 
        }, 
        select: function( event, ui ) {    
            this.value = ui.item.value;
            $(".cutnryid").val(ui.item.label);
            event.preventDefault();
        } 
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append( "<div>" + item.value + "</div>" )
                .appendTo( ul );
    }; 
}
/*
var selct2  =   function(){
    $(".select3").select2({
        placeholder:"Select Subjects",
        tags: true,
        allowClear:true
    });
     $(".selectset").select2({
        placeholder:"Select Students",
        tags: true,
        allowClear:true
    });
};
*/
function travelthis(){
        var  studentravel   =   $(".studentravel").is(":checked");
        if(studentravel){
            $('.studentrkm').show();
            $(".studentext").attr("required","required");
        }else{
            $(".studentext").removeAttr("required");
            $('.studentrkm').hide();
        }
}

function itemamount(){
    var prince  =   $('.prince').val();
    var packing =   $('.packing').val();
    var vat     =   $('.vat option:selected').val();  
	if(vat!="undefined"){
		var v = vat;
	}else{
		var v = 0;
	}
    if(prince !="" && packing!="" && vat !=""){
        var total = parseFloat(prince)+parseFloat(packing);
        var vata = (total*vat)/100;
        $('.total').val(parseFloat(total)+parseFloat(vata));
    }else if(prince !="" && packing!=""){
		var total = parseFloat(prince)+parseFloat(packing);
		$('.total').val(parseFloat(total));
	}else if(prince !=""){
		$('.total').val(parseFloat(prince));
	}
}
function timmes(eve){
    if(eve=="alltime"){
        $('#alldays').css('display','none');
        $('.differentdays').css('display','none');
        $('.differentdays').empty();
        $('#alldays').empty();
    }else if(eve=="alldays"){
        $('#alldays').css('display','block');
        $('.differentdays').css('display','none');
		$.post(partnerurl+"/Weely-Avaliable",{eve:eve},function(data){
			$('#alldays').html(data);
			$('.differentdays').empty();
		});
    }else if(eve=="differentdays"){
        $('#alldays').css('display','none');
        $('.differentdays').css('display','block');
		$.post(partnerurl+"/Weely-Avaliable",{eve:eve},function(data){
			$('#differentdays').html(data);
            $('#alldays').empty();
		});
    }
}
function timmesadmin(eve){
    if(eve=="alltime"){
        $('#alldays').css('display','none');
        $('.differentdays').css('display','none');
        $('.differentdays').empty();
        $('#alldays').empty();
    }else if(eve=="alldays"){
        $('#alldays').css('display','block');
        $('.differentdays').css('display','none');
		$.post(adminurl+"/Weely-Avaliable",{eve:eve},function(data){
			$('#alldays').html(data);
			$('.differentdays').empty();
		});
    }else if(eve=="differentdays"){
        $('#alldays').css('display','none');
        $('.differentdays').css('display','block');
		$.post(adminurl+"/Weely-Avaliable",{eve:eve},function(data){
			$('#differentdays').html(data);
            $('#alldays').empty();
		});
    }
}
function myevent(action){
    var eve = $(".alltime").attr('data-value');
    var eve2 = $("#inncer").attr('data-value');
	localStorage.i = Number(1);
    var i = Number(localStorage.i);
    var div = document.createElement('div');
    if(action.id == "add"){
        var category_id = $(".alltime").val();
        //localStorage.i = Number(localStorage.i) + Number(1);
        var i = parseInt(eve)+parseInt(1);
        var j = parseInt(eve2)-parseInt(1);
        var id = i;
        var ids = i;
        div.id = id;
        $(".alltime").attr('data-value',i);
        if(i=="3"){
            $('#add').css('display','none');
        }else if(i!="3"){
            $('#add').css('display','block');
        }
        $("#inncer").html(j);
        $("#inncer").attr('data-value',j);
        div.innerHTML = '<div class="row m-3"><div class="col-md-3"></div>'+
                        '<div class="col-md-3">'+
                            '<input id="timepicker'+i+'" class="form-control flatpickr flatpickr-input" type="time" placeholder="Select Date..">'+
                        '</div>'+
                        '<div class="col-md-3">'+
                            '<input id="timepicker1'+i+'" class="form-control flatpickr flatpickr-input" type="time" placeholder="Select Date.." >'+
                        '</div>'+
                        '<div class="col-md-3">'+
                            '<a href="javascript:void(0);" id='+id+' class="remCF" onclick="myevent(this)">Remove</a>'+
                        '</div></div>';
            document.getElementById('AddDel').appendChild(div);
    }else{
        var i = parseInt(eve)-parseInt(1);
        var j = parseInt(eve2)-parseInt(1);
        var element = document.getElementById(action.id);
        $(".alltime").attr('data-value',i);
        $("#inncer").html(j);
        $("#inncer").attr('data-value',j);
        if(i=="3"){
            $('#add').css('display','none');
        }else if(i!="3"){
            $('#add').css('display','block');
        }
        element.parentNode.removeChild(element);
    }
}
function addon(eve){
    var title = $('.addon'+eve).attr('data-title'+eve);
    var total = $('.total').val();
    var tempid = $('#tempid').val();
    $.post(partnerurl+"/Addon-model",{eve:eve,title:title,total:total,tempid:tempid},function(data){
        $('.bd-example-modal-lgs').modal('show');
		$('.modal-content.addon').html(data);
	});
}
function addons(eve){
    var title = $('.addon'+eve).attr('data-title'+eve);
    var total = $('.total').val();
    var tempid = $('#tempid').val();
    $.post(adminurl+"/Addon-model",{eve:eve,title:title,total:total,tempid:tempid},function(data){
        $('.bd-example-modal-lgs').modal('show');
		$('.modal-content.addon').html(data);
	});
}

function updateimag(eve){
    var imageid =  eve;
    $.post(adminurl+"/Update-Res-Images",{imageid:imageid},function(data){
        //('bd-example-modal-lgs').
        $('.bd-example-modal-md').modal('show');
		$('.pinkey').html(data);
	});
}
function variant(eve){
    var title   = $('.variant'+eve).attr('data-title'+eve);
    var id      = $('.variant'+eve).attr('data-ids'+eve);
    var total   = $('.total').val();
    var tempid  = $('#tempid').val();
    if(id == "0" || id == "undefined"){
        var ids ="0";
    }else{
        var ids ="1";
    }
    $('.modal-content').empty();
    $.post(partnerurl+"/Variant-model",{eve:eve,title:title,total:total,tempid:tempid,ids:ids},function(data){
        $('.bd-example-modal-lgs').modal('show');
		$('.modal-content.addon').html(data);
	});
}
function variants(eve){
    var title   = $('.variant'+eve).attr('data-title'+eve);
    var id      = $('.variant'+eve).attr('data-ids'+eve);
    var total   = $('.total').val();
    var tempid  = $('#tempid').val();
    var resturantid  = $('#resturant_id').val();
    if(id == "0" || id == "undefined"){
        var ids ="0";
    }else{
        var ids ="1";
    }
    $('.modal-content').empty();
    $.post(adminurl+"/Variant-model",{eve:eve,title:title,total:total,tempid:tempid,ids:ids,resturantid:resturantid},function(data){
        $('.bd-example-modal-lgs').modal('show');
		$('.modal-content.addon').html(data);
	});
}
function addonsitems(action,ids){
    //alert(ids);
    var eve = $("#addonitems").attr('data-value');
    var itemamount = $('#item_amount').val();
	localStorage.i = Number(1);
    var i = Number(localStorage.i);
    var div = document.createElement('div');
    if(action.id == "addonitems"){
        var i = parseInt(eve)+parseInt(1);
        var id = i;
        div.id = id;
        $.post(partnerurl + "/Veg-Types", function (data){
            var option  = data;
            $('.veg_types'+i).html(data);
        });
        $(".addonitems").attr('data-value',id);
        var innerHTML = '<div class="row addonrows'+id+'">'+
                            '<div class="col-md-3">'+
                                '<input type="hidden" class="variantsids" name="variantsid[]" value="">'+
                                '<input type="radio" class="from-control defelat" name="defelat[]" value="'+id+'">'+
                                '<label></label>'+
                                '<input type="text" class="form-control addonoption" name="resturant_addon_option[]" placeholder="Option Name" required/>'+
                            '</div>'+
                            '<div class="col-md-3">'+
                                '<label></label>'+
                                '<select class="form-control veg veg_types'+id+'" name="veg[]" id="Veg_Types'+id+'" onchange="itemamount()" required="">'+
                                '</select>'+
                            '</div>'+
                            '<div class="col-md-1">'+
                                '<label>Item Price</label><br>'+
                                '<input type="hidden" name="item_amount" id="item_amount" value="'+itemamount+'" required/>'+
                                '</div>'+
                            '<div class="col-md-2">'+
                                '<label style="font-size: 11px;">Additional Price</label><br>'+
                                '<input type="number" class="form-control addprince addprice'+id+'" id="addprice'+id+'" name="addon_amount[]" onchange="addvariant('+id+')" placeholder="0" required/>'+
                            '</div>'+
                            '<div class="col-md-2">'+
                                '<label>Final Price</label><br>'+
                                '<input type="hidden" id="tol'+id+'"  name="total_amount[]"  required/>'+
                                '<span class="addontotal'+id+'">0</span>'+
                            '</div>'+
                            '<div class="col-md-1">'+
                                '<a href="javascript:void(0);" id='+id+' class="remCF" onclick="addonsitems(this,'+id+')">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>'+
                                '</a>'+
                            '<div>'+
                        '</div>';
        $('.AddDels').append(innerHTML);
    }else{
        var i = parseInt(eve)-parseInt(1);
        var element = document.getElementById(action.id);
        $(".addonitems").attr('data-value',i);
        //element.parentNode.removeChild(element);
        $('.addonrows'+ids).remove();
    }
}
function addvariant(eve){
    if($('#item_amount').val() != "0"){
        var itemamount  = $('#item_amount').val();
    }else{
        var itemamount = 0;
    }
    var addprices = $('.addprice'+eve).val();
    var total = itemamount+addprices;
    $('#tol'+eve).val(total);
    $('.addontotal'+eve).html(total);
}
function minselection(eve){
    $(".minselection").empty();
    $.post(partnerurl + "/Min-Selection",{eve:eve}, function (data){
        $(".minselection").append(data);
    });
}
function Compulsory(eve){
    if(eve == "1"){
        $('.minselection').attr('disabled', false);
    }else if(eve == "2"){
        $('.minselection').attr('disabled', true);
    }
}
$("#myform").on("submit", function(e) {
    var dataString = $(this).serialize();
    $.ajax({
        type: "POST",
        url: partnerurl + "/Add-Variant",
        data: dataString,
        success: function () {
            //$('.bd-example-modal-lgs').modal('hidden');
            alert('submited');
        }
    });
    e.preventDefault();
});
function addonsitemsvariants(action,ids){
    var eve = $("#Variants").attr('data-value');
	localStorage.i = Number(1);
    var i = Number(localStorage.i);
    var div = document.createElement('div');
    if(action.id == "Variants"){
        var i = parseInt(eve)+parseInt(1);
        var id = i;
        div.id = id;
        $(".variantsitem").attr('data-value',id);
        var innerHTML = '<div class="row addonrows'+id+' mt-30 pt-4">'+
                            '<div class="col-md-6">'+
                                '<input type="hidden" class="addon_listid" name="addon_listid[]" value="">'+
                                '<input type="text" class="form-control addonitem '+id+'" name="addonitem['+id+'][]" placeholder="Add On " required />'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<input type="number" class="form-control addonitem_amount '+id+'" name="addonitem_amount['+id+'][]" placeholder="Add Item amount" required />'+
                            '</div>'+
                            '<div class="col-md-2">'+
                                '<a href="javascript:void(0);" id='+id+' class="remCF" onclick="addonsitemsvariants(this,'+id+')"><b>Remove</b></a>'+
                            '</div>'+
                        '</div>';
        $('.Addvariants').append(innerHTML);
        minselection(id);
    }else{
        var i = parseInt(eve)-parseInt(1);
        var element = document.getElementById(action.id);
        $(".variantsitem").attr('data-value',i);
        $('.addonrows'+ids).remove();
        minselection(i);
    }
}

function checktextarea() {
    $(".addaminu").html("");
   var minLength = 25;
   var $textarea = $('.studentrequire');
   if($textarea.val().split(/\s+/).length < minLength) {
      $(".addaminu").html('You need to enter at least ' + minLength + ' words');
      return false;
   }
}
/*-------------Zone ----------------------*/
function lag(eve1,eve2){
    var zon = $('.zoneName').val();
    var zons = $('.zoneName').attr('data-value');
    if(zon !="" && zon.length > 0){
        $('.old-row').remove();
        var id = $('.zoneName').attr('data-value');
        var i = parseInt(id)+parseInt(1);
        $(".zoneName").attr('data-value',i);
        if(eve1 !="" && eve2 !=""){
            var innerHTML = '<div class="row" id="lagrows'+i+'">'+
                            '<div class="col-md-1">'+
                                '<label></label><br>'+
                                '<span>'+i+'.</span>'+
                            '</div>'+
                            '<div class="col-md-5">'+
                                '<label>Latitude</label>'+
                                '<input type="text" class="form-control" name="lat[]" value="'+eve1+'" id="lat'+i+'">'+
                            '</div>'+
                            '<div class="col-md-5">'+
                                '<label>Longitude</label>'+
                                '<input type="text" class="form-control" name="lng[]" value="'+eve2+'" id="lng'+i+'">'+
                            '</div>'+
                            '<div class="col-md-1">'+
                                '<label></label><br>'+
                                '<a href="javascript:void(0);" data-id='+id+' id="'+id+'" class="remCF" onclick="remove(this)">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>'+
                                '</a>'+
                            '</div>'+
                        '</div>';
            $('.newlag').append(innerHTML);
        }else{
            var i = parseInt(zons)-parseInt(1);
            var element = document.getElementById(action.id);
            $(".zoneName").attr('data-value',i);
            $('.lagrows'+i).remove();
        }
        return true;
    }else{
        alert('Enter Zone Name.');
    }
}
function remove(action){
    $('#lagrows'+action.id).remove();
}
/*-------------Enfd Zone ----------------------*/
/*-------------Add addcategory ----------------------*/
function addcategory(){
    var title = $('.addcategory').attr('data-title');
    $.post(partnerurl+"/Add-Category",{title:title},function(data){
        $('#exampleModalCenter').modal('show');
		$('.datas').html(data);
	});
}
function addcategorys(){
    var title = $('.addcategory').attr('data-title');
    $.post(adminurl+"/Add-Category",{title:title},function(data){
        $('#exampleModalCenter').modal('show');
		$('.datas').html(data);
	});
}
function addingcategort(){
    var category = $('.category').val();
    var category_a = $('.category_a').val();
    $.post(partnerurl+"/Adding-Category",{category:category,category_a:category_a},function(data){
        var html ='<div class="alert alert-success">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<i class="material-icons">close</i>'+
                        '</button>'+
                        data
                    '</div>';
		$('.msgs').html(html);
		$('.categorybutton').css('display','none');
		$('.loading').css('display','block');
		setTimeout(function(){
           window.location.reload(1);
        }, 3000);
	});
}
function updatecategorys(x){
    var title = 'Update Category';
    $.post(adminurl+"/Update-Category/"+x,{title:title},function(data){
        $('#exampleModalCenter').modal('show');
		$('.datas').html(data);
	});
}
function updatingcategortss(x){
    var category = $('.category').val();
    var category_a = $('.category_a').val();
    var rastid = $('#rastid').val();
    $.post(adminurl+"/Updating-Category/"+x,{category:category,category_a:category_a,rastid:rastid},function(data){
        var html ='<div class="alert alert-success">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<i class="material-icons">close</i>'+
                        '</button>'+
                        data
                    '</div>';
		$('.msgs').html(html);
		$('.categorybutton').css('display','none');
		$('.loading').css('display','block');
		setTimeout(function(){
           window.location.reload(1);
        }, 3000);
	});
}
function addingcategorts(){
    var category = $('.category').val();
    var category_a = $('.category_a').val();
    $.post(adminurl+"/Adding-Category",{category:category,category_a:category_a},function(data){
        var html ='<div class="alert alert-success">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<i class="material-icons">close</i>'+
                        '</button>'+
                        data
                    '</div>';
		$('.msgs').html(html);
		$('.categorybutton').css('display','none');
		$('.loading').css('display','block');
		setTimeout(function(){
           window.location.reload(1);
        }, 3000);
	});
}
function addingcategortss(){
    var category = $('.category').val();
    var category_a = $('.category_a').val();
    var rastid = $('#rastid').val();
    $.post(adminurl+"/Adding-Category",{category:category,category_a:category_a,rastid:rastid},function(data){
        var html ='<div class="alert alert-success">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<i class="material-icons">close</i>'+
                        '</button>'+
                        data
                    '</div>';
		$('.msgs').html(html);
		$('.categorybutton').css('display','none');
		$('.loading').css('display','block');
		setTimeout(function(){
           window.location.reload(1);
        }, 3000);
	});
}
function addcategorydelete(eve){
    var rastid = $('#rastid').val();
    $.post(adminurl+"/Category-Rest-Delete",{eve:eve,rastid:rastid},function(data){
        var html ='<div class="alert alert-success">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<i class="material-icons">close</i>'+
                        '</button>'+
                        data
                    '</div>';
		$('.msgs').html(html);
		$('.loading').css('display','block');
		setTimeout(function(){
           window.location.reload(1);
        }, 3000);
	});
}
/*-------------Enfd addcategory ----------------------*/

function addonvariant(){
        var addonitem = [];
        $(".addonitem").each(function (){
            var sThisVal = $(this).val();
            if(sThisVal != ''){
                addonitem.push(sThisVal);
            }
        });
        var addonitem_amount = [];
        $(".addonitem_amount").each(function (){
            var sThisVals = $(this).val();
            if(sThisVals != ''){
                addonitem_amount.push(sThisVals);
            }
        });
        var addon_listid = [];
        $(".addon_listid").each(function (){
            var sThisVals = $(this).val();
            if(sThisVals != ''){
                addon_listid.push(sThisVals);
            }
        });
        var eve                 = $("#eve").val();
        var tempid              = $("#tempid").val();
        var addonoption         = $(".addonoption").val();
        var selection           = $("input[name='selection']:checked").val();
        var minselection        = $('.minselection option:selected').val();   
        var maxvalue            = $('.maxvalue option:selected').val();   
        var addonitem           = addonitem;
        var addonitem_amount    = addonitem_amount;
        if(eve == "0" || eve == ""){
            if(addonoption == ""){
                $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong>Enter Title of customization </div>');
            }else{
                $.post(partnerurl+"/Adding-variant",
                {eve:eve,tempid:tempid,selection:selection,minselection:minselection,addonitem:addonitem,addonitem_amount:addonitem_amount,maxvalue:maxvalue,addon_listid:addon_listid,addonoption:addonoption},
                function(data){
                    if(data == 1){
                        $('.msg').html('<div class="alert alert-primary mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Successfully!</strong> Addons Adding Successfully</div>');
                        setTimeout(function(){
                           $('.bd-example-modal-lgs').modal('hide');
                        }, 3000);
                    }else{
                        $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong> Addons Adding Failed</div>');
                    }
                });
            }
        }else{
            $.post(partnerurl+"/Adding-variant",
            {eve:eve,tempid:tempid,selection:selection,minselection:minselection,addonitem:addonitem,addonitem_amount:addonitem_amount,maxvalue:maxvalue,addon_listid:addon_listid},
            function(data){
                if(data == 1){
                    $('.msg').html('<div class="alert alert-primary mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Successfully!</strong> Addons Adding Successfully</div>');
                    setTimeout(function(){
                       $('.bd-example-modal-lgs').modal('hide');
                    }, 3000);
                }else{
                    $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong> Addons Adding Failed</div>');
                }
            });
        }
}

function addonvariants(){
        var addonitem = [];
        $(".addonitem").each(function (){
            var sThisVal = $(this).val();
            if(sThisVal != ''){
                addonitem.push(sThisVal);
            }
        });
        var addonitem_amount = [];
        $(".addonitem_amount").each(function (){
            var sThisVals = $(this).val();
            if(sThisVals != ''){
                addonitem_amount.push(sThisVals);
            }
        });
        var addon_listid = [];
        $(".addon_listid").each(function (){
            var sThisVals = $(this).val();
            if(sThisVals != ''){
                addon_listid.push(sThisVals);
            }
        });
        var eve                 = $("#eve").val();
        var tempid              = $("#tempid").val();
        var addonoption         = $(".addonoption").val();
        var selection           = $("input[name='selection']:checked").val();
        var minselection        = $('.minselection option:selected').val();   
        var maxvalue            = $('.maxvalue option:selected').val();   
        var addonitem           = addonitem;
        var addonitem_amount    = addonitem_amount;
        if(eve == "0" || eve == ""){
            if(addonoption == ""){
                $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong>Enter Title of customization </div>');
            }else{
                $.post(adminurl+"/Adding-variant",
                {eve:eve,tempid:tempid,selection:selection,minselection:minselection,addonitem:addonitem,addonitem_amount:addonitem_amount,maxvalue:maxvalue,addon_listid:addon_listid,addonoption:addonoption},
                function(data){
                    if(data == 1){
                        $('.msg').html('<div class="alert alert-primary mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Successfully!</strong> Addons Adding Successfully</div>');
                        setTimeout(function(){
                           $('.bd-example-modal-lgs').modal('hide');
                        }, 3000);
                    }else{
                        $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong> Addons Adding Failed</div>');
                    }
                });
            }
        }else{
            $.post(adminurl+"/Adding-variant",
            {eve:eve,tempid:tempid,selection:selection,minselection:minselection,addonitem:addonitem,addonitem_amount:addonitem_amount,maxvalue:maxvalue,addon_listid:addon_listid},
            function(data){
                if(data == 1){
                    $('.msg').html('<div class="alert alert-primary mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Successfully!</strong> Addons Adding Successfully</div>');
                    setTimeout(function(){
                       $('.bd-example-modal-lgs').modal('hide');
                    }, 3000);
                }else{
                    $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong> Addons Adding Failed</div>');
                }
            });
        }
}
function addonslist(){
    var tempid              = $("#tempid").val();
    $.post(adminurl+"/Addons-List",{tempid:tempid},function(data){
        $('.addonslist').html(data);
    });
    $.post(adminurl+"/variants-List",{tempid:tempid},function(data){
        $('.variantslist').html(data);
    });
    
}
function add_variant(){
        var variantsid = [];
        $(".variantsids").each(function (){
            var sThisValX = $(this).val();
            if(sThisValX != ''){
                variantsid.push(sThisValX);
            }
        });
        var addonoption = [];
        $(".addonoption").each(function (){
            var sThisVal = $(this).val();
            if(sThisVal != ''){
                addonoption.push(sThisVal);
            }
        });
        var veg = [];
        $(".veg").each(function (){
            var sThisVals = $(this).val();
            if(sThisVals != ''){
                veg.push(sThisVals);
            }
        });
        var addprince = [];
        $(".addprince").each(function (){
            var sThisValss = $(this).val();
            if(sThisValss != ''){
                addprince.push(sThisValss);
            }
        });
        var defelat = [];
        $(".defelat").each(function (){
            var sThisValss = (this.checked ? $(this).val() : "");
            if(sThisValss != ''){
                defelat.push(sThisValss);
            }
        });
        var eve                 = $("#eve").val();
        var tempid              = $("#tempid").val();
        var total               = $("#total").val();
        var restid              = $("#restid").val();
        var customization       = $(".customization").val();
        var addonoption         = addonoption;
        var veg                 = veg;
        var addprince           = addprince;
        var defelat             = defelat;
        var variantsid          = variantsid;
        if(eve == "0" || eve == ""){
            if(customization == ""){
                $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong>Enter Title of customization </div>');
            }else{
                $.post(partnerurl+"/Adding-variants",
                    {eve:eve,tempid:tempid,total:total,addonoption:addonoption,veg:veg,addprince:addprince,defelat:defelat,variantsid:variantsid,customization:customization,restid:restid},
                    function(data){
                    if(data == 1){
                        $('.msg').html('<div class="alert alert-primary mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Successfully!</strong> variants Adding Successfully</div>');
                        setTimeout(function(){
                           $('.bd-example-modal-lgs').modal('hide');
                        }, 3000);
                    }else{
                        $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong> variant Adding Failed</div>');
                    }
                });
            }
        }else{
            $.post(partnerurl+"/Adding-variants",
                {eve:eve,tempid:tempid,total:total,addonoption:addonoption,veg:veg,addprince:addprince,defelat:defelat,variantsid:variantsid,customization:customization,restid:restid},
                function(data){
                if(data == 1){
                    $('.msg').html('<div class="alert alert-primary mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Successfully!</strong> variants Adding Successfully</div>');
                    setTimeout(function(){
                       $('.bd-example-modal-lgs').modal('hide');
                    }, 3000);
                }else{
                    $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong> variant Adding Failed</div>');
                }
            });
        }
}
function add_variants(){
        var variantsid = [];
        $(".variantsids").each(function (){
            var sThisValX = $(this).val();
            if(sThisValX != ''){
                variantsid.push(sThisValX);
            }
        });
        var addonoption = [];
        $(".addonoption").each(function (){
            var sThisVal = $(this).val();
            if(sThisVal != ''){
                addonoption.push(sThisVal);
            }
        });
        var veg = [];
        $(".veg").each(function (){
            var sThisVals = $(this).val();
            if(sThisVals != ''){
                veg.push(sThisVals);
            }
        });
        var addprince = [];
        $(".addprince").each(function (){
            var sThisValss = $(this).val();
            if(sThisValss != ''){
                addprince.push(sThisValss);
            }
        });
        var defelat = [];
        $(".defelat").each(function (){
            var sThisValss = (this.checked ? $(this).val() : "");
            if(sThisValss != ''){
                defelat.push(sThisValss);
            }
        });
        var eve                 = $("#eve").val();
        var tempid              = $("#tempid").val();
        var total               = $("#total").val();
        var customization       = $(".customization").val();
        var restid              = $(".restid").val();
        var addonoption         = addonoption;
        var veg                 = veg;
        var addprince           = addprince;
        var defelat             = defelat;
        var variantsid          = variantsid;
        if(eve == "0" || eve == ""){
            if(customization == ""){
                $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong>Enter Title of customization </div>');
            }else{
                $.post(adminurl+"/Adding-variants",
                    {eve:eve,tempid:tempid,total:total,addonoption:addonoption,veg:veg,addprince:addprince,defelat:defelat,variantsid:variantsid,customization:customization,restid:restid},
                    function(data){
                    if(data == 1){
                        $('.msg').html('<div class="alert alert-primary mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Successfully!</strong> variants Adding Successfully</div>');
                        setTimeout(function(){
                           $('.bd-example-modal-lgs').modal('hide');
                        }, 3000);
                    }else{
                        $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong> variant Adding Failed</div>');
                    }
                });
            }
        }else{
            $.post(adminurl+"/Adding-variants",
                {eve:eve,tempid:tempid,total:total,addonoption:addonoption,veg:veg,addprince:addprince,defelat:defelat,variantsid:variantsid,customization:customization,restid:restid},
                function(data){
                if(data == 1){
                    $('.msg').html('<div class="alert alert-primary mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Successfully!</strong> variants Adding Successfully</div>');
                    setTimeout(function(){
                       $('.bd-example-modal-lgs').modal('hide');
                    }, 3000);
                }else{
                    $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong> variant Adding Failed</div>');
                }
            });
        }
}

function itemchange(eve){
    var status = $('#itemid'+eve).attr('data-status'+eve);
    if(status =="Active"){
        var status = "Deactive";
    }else{
        var status = "Active";
    }
    $.post(partnerurl+"/Active-Inactive-Item",{eve:eve,status:status},function(data){
        if(data == 1){
            alertmsg(data);
        }else if(data == 0){
            swal("No permissions ....!!!", '');
        } else {
            swal("Not updated any ....!!!", '');
        }
    });
}
function itemchanges(eve){
    var status = $('#itemid'+eve).attr('data-status'+eve);
    if(status =="Active"){
        var status = "Deactive";
    }else{
        var status = "Active";
    }
    $.post(adminurl+"/Active-Inactive-Item",{eve:eve,status:status},function(data){
        if(data == 1){
            alertmsg(data);
        }else if(data == 0){
            swal("No permissions ....!!!", '');
        } else {
            swal("Not updated any ....!!!", '');
        }
    });
}
function alertmsg(eve){
    if(eve == 1){
        var msg = "Item active successfully";
    }else{
        var msg = "Item Deactive successfully";
    }
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
/**
function timer(){
    var i = 60;
    (function timer(){
        if (--i < 0) return;
        setTimeout(function(){
            $('#timer').html(i + ' secs');
            timer();
            if(i == '1'){
                timer();
            }
        }, 1000);
    })();
}*/


$(document).ready(function() {
    setInterval(function() {
      loadorders();
      //timer();
    }, 60000);
});

function loadorders(){
    //alert();
}

var sumInitvalue  = function(){
    $("textarea.tutovalue").summernote({
        height: 350,
        codemirror: {
            theme: 'monokai'
        }
    });
};


function orderModel(eve,eve1){
    //alert(eve1);
    $('.orders'+eve).css('visibility','hidden');
    $('.loader'+eve).css('display','block');
    $('.loader'+eve).html('<div class="spinner-border text-success  align-self-center"></div>');
    var types = $('#orders'+eve).attr('data-types'+eve);
    var status = $('#orders'+eve).attr('data-status'+eve);
    $.post(partnerurl+"/Order-Details",{eve:eve,types:types,status:status,restraint_id:eve1},function(data,status, jqXHR){
        $('.orders'+eve).css('visibility','visible');
        $('.loader'+eve).css('display','none');
        $('.orderModel').modal('show');
		$('.modal-content.orderModel').html(data);
		console.log(jqXHR);
		console.log(status);
    });
}
function closeorder(eve){
    $('.orders'+eve).css('visibility','visible');
    $('.loader'+eve).css('display','none');
}
function accectorder(eve){
    var status = $('.orders').attr('data-title');
    var restid = $('.restid').attr('data-value');
    $.post(partnerurl+"/Order-Accect",{eve:eve,status:status,restid:restid},function(data,status, jqXHR){
        if(data == 1){
            $('.msg').html('<div class="alert alert-primary mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Successfully!</strong> Order Accepted</div>');
            setTimeout(function(){
               $('.orderModel').modal('hide');
               window.location.reload();
            }, 3000);
            
        }else{
            $('.msg').html('<div class="alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Failed!</strong> Order Accepted Failed</div>');
        }
    });
}
function getRes(){
    var x   =  $('.zone_dat option:selected').val();
    var y   =  $('.subzone_dat option:selected').val();
    var zone    =   [x,y];
    //alert(zone);
    $.post(adminurl+"/Ajax-Res-List",{zone :zone},function(data){
        if(data == 1){
            alert("zone or sub zone should not be empty");
            $('.alloc_res').empty();
        }else{
            $('.alloc_res').empty();
            $('.alloc_res').append(data);
        }
        
    });
}
function helpdeskcats(){
    $('.helpdesksubcat').empty();
    var helpdeskcat   =   $('.helpdeskcat option:selected').val();   
    $.post(partnerurl+"/Helpdesk-Category-List",{helpdeskcat:helpdeskcat},function(data,status, jqXHR){
        $('.helpdesksubcat').html(data);
    });
}
function zonename(){
    var zname = $('.zoneName').val();
    if(zname !=""){
        $.post(adminurl+"/validation-Zonename",{zname:zname},function(data,status, jqXHR){
            if(data == 1){
                $('.invalid-feedback').css('display','block');
                $('.error-zone').html('Zone Name already exsting.');
                $(".publish").prop("disabled", true);
            }else{
                $(".publish").removeAttr('disabled');
                $('.invalid-feedback').css('display','none');
            }
        });
    }else{
        $('.invalid-feedback').css('display','block');
        $('.error-zone').html('Zone Name Empty.');
        $(".publish").prop("disabled", true);
    }
}

function updatedriloca(){
    var der = $('.driverid').val();
    $.post(adminurl+"/Update-Drive-Loc",{der:der},function(data){
        $('.maps-update').html(data);
        setInterval(updatedriloca, 20000);
    });
}
// setInterval(function(){ 
//     OrderRefresh();
// }, 5000);
function OrderRefresh(){
    url = $('#urlvalue').val();
    searchFilter('',url,'');
    counts();//alert(interval);
    //clearInterval(interval);
    //timer();
   // timer();
}
function timer(){
    var counter = 60;
    var interval = setInterval(function() {
        counter--;
        // Display 'counter' wherever you want to display it.
        if (counter <= 0) {
                clearInterval(interval);
                OrderRefresh();
                timer();
            return;
        }else{
            $('#time').text(counter);
        //console.log("Timer --> " + counter);
        }
    }, 1000);
}

function counts(){
        $.ajax({
            type    :   'POST',
            url     :   adminurl+'/Counts',
            data:{
            }, 
            success: function (html) { 
                var d    =   JSON.parse(html);
                if(d.status=='1'){
                    d.status_messsage.forEach(coount);
                    function coount(item, index) {
                        if(item > 0){
                            $('#lin'+index).addClass('alert-danger');
                        }
                    }
                   
                }   
            }
        });   
}
function copyId(x){
    var text = x;
    navigator.clipboard.writeText(text).then(function() {
      alert('Copying to clipboard was successful!');
    }, function(err) {
      alert('Async: Could not copy text: ', err);
    });
}
function partneractiveform(evt,page){
    var fields  =   evt.attr("fields");
    var status  =   evt.attr("title");
    swal({
        title: 'Are you sure?',
        text: "Are you sure you want to " + status,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        padding: '2em'
    }).then(function(result) {
        if (result.value) {
            $.post(partnerurl+"/"+page,{status:status,fields:fields},function(data){
                if(data == 1){
                    loadpage();
                }else if(data == 0){
                    swal("No permissions ....!!!", '');
                } else {
                    swal("Not updated any ....!!!", '');
                }
            });
            swal(
              status,
              'Your file has been '+status,
              'success'
            )
        }else{
            swal("Not updated any ....!!!", status);
        }
    })
}
function checkall(cla){
    var cclass   =cla;
    var boxes = $('.m'+cclass).is(':checked');
    if(boxes){
        $('.'+cclass).prop('checked', true);
    }else{
        $('.'+cclass).prop('checked', false);
    }
}
function discType(){
    var disc =  $("#exampleFormControlSelect1 option:selected").val();
    if(disc == ''){
        $('.discc').show();
    }else if(disc=='Percentage'){
        $('#basic-addon2').html('<i class="fa fa-percent" aria-hidden="true"></i>');
        $('.discc').hide();
    }else if(disc=='Amount'){
        $('#basic-addon2').html('KD');
        $('.discc').hide();
    }
}
function typeee(){
    var type =  $("#tyyy option:selected").val();
    alert(type);
    if(type=='Category Wise'){
        $("#catt").show();
        $(".produc").hide();
    }else if(type=='Product Wise'){
        $(".produc").show();
        $("#catt").show();
    }else{
        $("#catt").hide();
        $("#produc").hide();
    }
}
$(function(){ 
        travelthis();
        pageform();
        //selct2();
        //sumInitvalue();
        loadpage();
        initPart();
        //formInit();
        //timer();
        counts();
        addonslist();
});