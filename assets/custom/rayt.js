var adminurl    = '/Rayt-Admin';
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
function getdatafiled(event) {   
        initPart();
        $("#tipoOrderby").val(event.data("field"));
        $("#orderby").val(event.data("order")); 
        $("#vtipoOrderby").val(event.data("field"));
        $("#vorderby").val(event.data("order")); 
        searchFilter('',event.attr("urlvalue"));
}
function searchFilter(page_num,url) {
        page_num        =   page_num?page_num:0; 
        var keywords    =   $('#FilterTextBox').val();      
        var secserach   =   $('.secserach option:selected').val();   
        var classserch  =   $('.classserch option:selected').val();   
        var schoolserch =   $('.schoolserch option:selected').val();   
        var limitvalue  =   $('.limitvalue option:selected').val();   
        var vspvalue    =   $("#vspvalue").val();
        var vspcalss    =   "postList";
        var topv        =   $("#tipoOrderby").val();
        var orderby     =   $("#orderby").val();
        var clf     =   "pageloaderwrapper";
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
                        keywords    :   keywords
                },
                beforeSend: function(){
                        $('.'+clf).show();
                }, 
                success: function (html) { 
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
    swal({
            title: "Delete " + val,
            text: "Once deleted, you will not be able to recover this "+val,
            icon: "warning",
            buttons: true,
            dangerMode: true,
    }).then((willDelete) => {
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
    });
} 
function activeform(evt,page){
    var fields  =   evt.attr("fields");
    var status  =   evt.attr("title");
    swal({
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
    });
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
        menudepth();
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
function checktextarea() {
    $(".addaminu").html("");
   var minLength = 25;
   var $textarea = $('.studentrequire');
   if($textarea.val().split(/\s+/).length < minLength) {
      $(".addaminu").html('You need to enter at least ' + minLength + ' words');
      return false;
   }
}
var sumInitvalue  = function(){
    $("textarea.tutovalue").summernote({
        height: 350,
        codemirror: {
            theme: 'monokai'
        }
    });
};
$(function(){ 
        travelthis();
        pageform();
        selct2();
        sumInitvalue();
        loadpage();
        initPart();
        formInit();
});