function openNav() {
    var x = document.getElementById("mySidenav");
    var element = document.getElementById("main_content");
    if( x.style.display == "block"){
        element.classList.remove("col-md-10");
        element.classList.add("col-md-12");
        x.style.display = "none";
    }else{
        element.classList.remove("col-md-12");
        element.classList.add("col-md-8");
        x.style.display = "block";
    }
}
  
function closeNav() {
    var x = document.getElementById("mySidenav");
    x.style.display = "none";
}
function imagesShow(x){
    // var x="";
    // for(var i=0;this.files[i]!='' ; i++){
    //     x += window.URL.createObjectURL(this.files[i]);
    // }
    // document.getElementById('output').innerHTML=x;
    document.getElementById(x).src = window.URL.createObjectURL(this.files[0]);
    //alert(window.URL.createObjectURL(this.files));
}
window.onload = function() {
    //Check File API support
    if (window.File && window.FileList && window.FileReader) {
      var filesInput = document.getElementById("files");
      filesInput.addEventListener("change", function(event) {
        var files = event.target.files; //FileList object
        var output = document.getElementById("result");
        for (var i = 0; i < files.length; i++) {
          var file = files[i];
          //Only pics
          if (!file.type.match('image'))
            continue;
          var picReader = new FileReader();
          picReader.addEventListener("load", function(event) {
            var picFile = event.target;
            var div = document.createElement("div");
            div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
              "title='" + picFile.name + "' width='100px'/>";
            output.insertBefore(div, null);
          });
          //Read the image
          picReader.readAsDataURL(file);
        }
      });
    } else {
      console.log("Your browser does not support File API");
    }
  }
  
  
  
  /*--------------------select box js -----------------*/
  var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
  
  /*---------------------select box js end-----------*/
  
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
    var house_id    =   $('#house_id').val();     
    var types       =   $('.type').val();
    var status       =  $('.status').val();
    var limitvalue  =   $('.limitvalue option:selected').val();
    var vspcalss    =   "postList";
    var topv        =   $("#tipoOrderby").val();
    var orderby     =   $("#orderby").val();
    var clf         =   "pageloaderwrapper";
    $('.'+vspcalss).html(""); 
    $.ajax({
            type    :   'POST',
            url     :   url+'/'+page_num,
            data:{ 
                    tipoOrderby         :   topv,
                    orderby             :   orderby,
                    limitvalue          :   limitvalue,
                    keywords            :   keywords
                    
            },
            beforeSend: function(){
                    $('.'+clf).show();
            }, 
            success: function (html) { 
                    $('.'+clf).hide();
                    $('.'+vspcalss).html(html); 
                    //initPart();
            }
    });   
}  
function activeform(evt,page){
    var fields  =   evt.attr("fields");
    var status  =   evt.attr("title");
    $.post(page,{status:status,fields:fields},function(data){
        if(data == 1){
            //loadpage();
            location.reload(true);
        }else if(data == 0){
            swal("No permissions ....!!!", '');
        } else {
            swal("Not updated any ....!!!", '');
        }
    });
    /*swal({
        title: "Are you sure you want to " + status,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        //closeOnConfirm: false,
        //closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            $.post("/erp/School-Admin/"+page,{status:status,fields:fields},function(data){
                if(data == 1){
                    //loadpage();
                    location.reload(true);
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
}
function confirmationDelete(anchor, val) {
    var atr     =   anchor.attr("attrvalue");
            $.post(atr,function(data){
                if(data == 1){
                    location.reload(true);
                }
            });
   /* swal({
        title: "Delete " + val,
        text: "Once deleted, you will not be able to recover this "+val,
        icon: "warning",
        buttons: true,
        dangerMode: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (willDelete) {
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
} 
function user_role(){
        var vale = [];
        var modiul   =   [];
        var school   =   [];
        var sample = 0;
        $(".user_roles option:selected").map(function(i, el) {
                vale[i]   =   $(el).val();
                var atr = $(el).attr('data-tokens');
                if(atr <= 3){
                    $('.user_schools').attr("disabled", "disabled");
                }else{
                    $('.user_schools').removeAttr("disabled");
                }
        }); 
        $(".user_modules option:selected").map(function(fs, els) {
                modiul[fs]   =   $(els).val();
        }); 
        $(".user_schools option:selected").map(function(fs, els) {
                school[fs]   =   $(els).val();
        });
        $(".ajaxListPer").html("");
        $('.pageloaderwrapper').show();
        $.post("https://rayt.advitsoftware.com/Admin/AjaxPermission",{vale:vale,modiul:modiul,school:school},function(data){
                $(".ajaxListPer").html(data);
                $('.pageloaderwrapper').hide();
        });
        /*if(atr != 1 && atr != 2){
            $.post(adminurl+"/AjaxPermission-school",function(data){
                    $(".user_schools").html(data);
                    //$('.pageloaderwrapper').hide();
            });
        }*/
}
  
  
  