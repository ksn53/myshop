'use strict';
var orderbyGlobal = 0;
var orderbyDescGlobal = 0;
var itemnewGlobal = 0;
var itemsaleGlobal = 0;
var categoryGlobal = 0;
var lowpriceGlobal = 100;
var higthpriceGlobal = 9000;

//---------------------------------ДОБАВЛЕНО-в-рамках-работ--------------------------
//вывод блока с товаром
function itemsOutput(blockName, data)
{
    document.getElementById(blockName).innerHTML = "";
    for ( var i = 0; i < data.length; i++ ) {
        var itemWrapper = document.createElement('article');
            itemWrapper.className = "shop__item";// product";
            itemWrapper.id = `itemsOutput${i}`;
            itemWrapper.tabIndex = '0';
        document.getElementById(blockName).appendChild(itemWrapper);
        document.getElementById(`itemsOutput${i}`).appendChild(document.createElement('div')).id = `productImage${i}`;
        document.getElementById(`productImage${i}`).className = "product__image";
        document.getElementById(`productImage${i}`).appendChild(document.createElement('a')).id = `productUrl${i}`;
        document.getElementById(`productUrl${i}`).href = `/item?item=${data[i][0]}`;
        var itemImg = document.createElement('img');
            //itemImg.className = "product";
            itemImg.src = `${data[i][2]}`;
            itemImg.id = `itemImage${i}`;
        document.getElementById(`productUrl${i}`).appendChild(itemImg);
        var itemName = document.createElement('p');
            itemName.className = "product__name";
            itemName.innerHTML = `<a href="/item?item=${data[i][0]}">${data[i][1]}</a>`;
        document.getElementById(`itemsOutput${i}`).appendChild(itemName);
        var itemPrice = document.createElement('p');
            itemPrice.className = "product__price";
            itemPrice.innerHTML = `${data[i][3]} руб. `;
        document.getElementById(`itemsOutput${i}`).appendChild(itemPrice);
    }
}

//вывод списка с товарами
function itemlistOutput(blockName, data)
{
    document.getElementById(blockName).innerHTML = "";
    for ( var i = 0; i < data.length; i++ ) {
        var itemWrapper = document.createElement('div');

    if ( i % 2 == 0 ) {
itemWrapper.className = "itemListelementGray";
    } else {
itemWrapper.className = "itemListelement";
    }
            //itemWrapper.className = "itemListelementGray";
        itemWrapper.id = `itemsOutput${data[i][0]}`;
        itemWrapper.tabIndex = '0';
        document.getElementById(blockName).appendChild(itemWrapper);
        document.getElementById(`itemsOutput${data[i][0]}`).appendChild(document.createElement('p')).id = `productId${i}`;
        document.getElementById(`productId${i}`).className = "itemListId";
        document.getElementById(`productId${i}`).innerHTML = `${data[i][0]}`;

        var itemName = document.createElement('p');
            itemName.className = "itemListName";
            itemName.innerHTML = `<a href="/item?item=${data[i][0]}">${data[i][1]}</a>`;
        document.getElementById(`itemsOutput${data[i][0]}`).appendChild(itemName);
        var itemPrice = document.createElement('p');
            itemPrice.className = "itemListPrice";
            itemPrice.innerHTML = `${data[i][3]} руб. `;
        document.getElementById(`itemsOutput${data[i][0]}`).appendChild(itemPrice);
        var editForm = document.createElement('div');
            editForm.id = `editForm${i}`;
        document.getElementById(`itemsOutput${data[i][0]}`).appendChild(editForm);
        document.getElementById(`editForm${i}`).innerHTML = `<button  onclick="deleteItemFromList(${data[i][0]})" class="itemListButton">Удалить</button>
        <button onclick="editItemFromList(${data[i][0]})" class="itemListButton">Изменить</button>`;

    }
}

function deleteItemFromList(id)
{
$.ajax({
        type: 'GET',
        url: '/ajax',
        cache: false,
        dataType: 'json',
        data: {'id':id, 'mode':"DeleteItemFromList"},
        success: function(data){
            ajaxItemlist(0, 1);
        }
    });
}


function editItemFromList(id)
{
    document.location.href = `/edit?id=${id}`;
/*$.ajax({
        type: 'GET',
        url: '/edit',
        cache: false,
        dataType: 'json',
        data: {'id':id},
        success: function(data){

        }
    });*/
}

function paginatorOutput(blockName, itemsCount, active, category, numberOfItemsPerPage)
{
    document.getElementById(blockName).innerHTML = "";
    //число элементов на странице
    //var numberOfItemsPerPage = 9;
    //количество страниц
    var countPages = Math.trunc(itemsCount / numberOfItemsPerPage);
    if ((itemsCount % numberOfItemsPerPage) >= 1) countPages++;
    var countToShowPages = 7; //оличество отображаемых страниц
    var middleOfRow = Math.trunc(Math.floor(countToShowPages / 2)); //примерно половина всего ряда
    document.getElementById("itemsCount").innerHTML = itemsCount;
  if (countPages > 1) { // Всё это только если количество страниц больше 1
    /* Дальше вычисление первой выводимой страницы и последней (чтобы текущая страница была в середине) */
    var left = active - 1;
    var right = countPages - active;

    if ( left < middleOfRow ) {
      var start = 1;
    }
    else {
      var start = active - middleOfRow;
    }
    var end = start + countToShowPages - 1;

    if (end > countPages ) {
        start -= (end - countPages);
        end = countPages;
        if ( start < 1 ) {
            start = 1;
        }
    }
/*------------блок для отладки--------------------
    var testblock = document.createElement('div');
        testblock.id = "test";
        testblock.innerHTML = " itemsCount=" + itemsCount + " countPages=" + countPages + " middleOfRow=" + middleOfRow;
    document.getElementById(blockName).appendChild(testblock);*/
//--------------Дальше идёт вывод Pagination -->
    var paginatorWrapper = document.createElement('ul');
        paginatorWrapper.className = "shop__paginator paginator";
        paginatorWrapper.id = "paginator01";
    document.getElementById(blockName).appendChild(paginatorWrapper);
    if ( active != 1 ) {

    var paginatorFirstPage = document.createElement('a');
        paginatorFirstPage.href = "javascript://";
        paginatorFirstPage.id = "paginatorFirstPage";
        paginatorFirstPage.title = "Первая страница";
        paginatorFirstPage.setAttribute('onclick',`ajaxPostFunc(${category}, 1)`);
        paginatorFirstPage.onclick = function() {ajaxPostFunc(category, 1);};
        paginatorFirstPage.innerHTML ="&nbsp;&lt;&lt;&lt;&nbsp;";
        document.getElementById("paginator01").appendChild(paginatorFirstPage);

    var paginatorPrevpage = document.createElement('a');
    if (active == 2) {
        paginatorPrevpage.setAttribute('onclick',`ajaxPostFunc(${category}, 2)`);
        paginatorPrevpage.onclick = function() {ajaxPostFunc(category, 2);};
    } else {
        paginatorPrevpage.setAttribute('onclick',`ajaxPostFunc(${category}, ${active - start})`);
        paginatorPrevpage.onclick = function() {ajaxPostFunc(category, active - start);};
    }
        paginatorPrevpage.href = "javascript://";
        paginatorPrevpage.id = "paginatorPrevpage01";
        paginatorPrevpage.title = "Предыдущая страница";
        paginatorPrevpage.innerHTML ="&nbsp;&lt;&lt;&lt;&nbsp;";
        document.getElementById("paginator01").appendChild(paginatorPrevpage);
    }
    for (var i = start; i <= end; i++) {
        var paginatorLi = document.createElement('li');
            paginatorLi.id = `paginatorLi${i}`;
        document.getElementById("paginator01").appendChild(paginatorLi);
        document.getElementById(`paginatorLi${i}`).innerHTML = `<a href='javascript://' class='paginator__item' onclick='ajaxPostFunc(${category}, ${i})'>${i}</a>`;
        /*var paginatorLiA = document.createElement('a');
            paginatorLiA.href = "javascript://";
            paginatorLiA.id = `paginatorItem${i}`;
            paginatorLiA.className = "paginator__item";
            paginatorLiA.setAttribute('onclick',`ajaxPostFunc(${category}, ${i})`);
            paginatorLiA.onclick = function() {ajaxPostFunc(category, i);};
            paginatorLiA.innerHTML = i;
        document.getElementById(`paginatorLi${i}`).appendChild(paginatorLiA);*/
    }
    } // Всё это только если количество страниц больше 1
    //testblock.innerHTML += " start=" + start + " end=" + end + " active=" + active;
    var paginatorPstPage = document.createElement('a');
        paginatorPstPage.href = "javascript://";
        paginatorPstPage.id = "paginatorPstPage01";
        paginatorPstPage.title = "Следующая страница";
        paginatorPstPage.innerHTML ="&gt;&nbsp;&nbsp;";
        paginatorPstPage.setAttribute('onclick',`ajaxPostFunc(${category}, ${end})`);
        paginatorPstPage.onclick = function() {ajaxPostFunc(category, end);};
    document.getElementById("paginator01").appendChild(paginatorPstPage);
    var paginatorEndPage = document.createElement('a');
        paginatorEndPage.href = "javascript://";
        paginatorEndPage.id = "paginatorEndPage01";
        paginatorEndPage.title = "Последняя страница";
        paginatorEndPage.innerHTML ="&gt;&gt;&gt;";
        paginatorEndPage.setAttribute('onclick',`ajaxPostFunc(${category}, ${countPages})`);
        paginatorEndPage.onclick = function() {ajaxPostFunc(category, countPages);};
    document.getElementById("paginator01").appendChild(paginatorEndPage);
//    if ($active != $countPages) {
//      <a href="<?= $urlPage . ($active + 1) ?>" title="Следующая страница">&gt;&nbsp;&nbsp;</a>
//      <a href="<?= $urlPage . $countPages ?>" title="Последняя страница">&gt;&gt;&gt;</a>
    //}

} //end of function

function ajaxPostFunc(category, active)
{
$.ajax({
        type: 'POST',
        url: '/ajax',
        cache: false,
        dataType: 'json',
        data: {'category':category, 'active':active, 'orderby':orderbyGlobal, 'orderbydesc':orderbyDescGlobal,
                'new':itemnewGlobal, 'sale':itemsaleGlobal, 'lowprice':lowpriceGlobal, 'hightprice':higthpriceGlobal, 'count':9, 'mode':"GetItemsData"},
        success: function(data){
            var itemsCount = data.pop();
            itemsOutput("itemsList", data);
            paginatorOutput("paginatorWrapper", itemsCount, active, category, 9);
        }
    });
}

//вывод списка товаров для админки
function ajaxItemlist(category, active)
{
$.ajax({
        type: 'POST',
        url: '/ajax',
        cache: false,
        dataType: 'json',
        data: {'category':category, 'active':active, 'orderby':orderbyGlobal, 'orderbydesc':orderbyDescGlobal,
                'new':itemnewGlobal, 'sale':itemsaleGlobal, 'lowprice':lowpriceGlobal, 'hightprice':higthpriceGlobal, 'count':15, 'mode':"GetItemsData"},
        success: function(data){
            var itemsCount = data.pop();
            itemlistOutput("itemsList", data);
            paginatorOutput("paginatorWrapper", itemsCount, active, category, 15);
        }
    });
}

//добавляет категорию
function addCategory()
{
var category = document.getElementById("categoryName").value;
$.ajax({
        type: 'POST',
        url: '/ajax',
        cache: false,
        dataType: 'json',
        data: {'category':category, 'mode':"AddCategory"},
        success: function(data){
            document.getElementById("categoryName").value = "";
            var itemWrapper = document.createElement('category');
                itemWrapper.className = "itemInList";
                itemWrapper.id = `itemsOutput${data[0][0]}`;
                itemWrapper.innerHTML = `${data[0][1]}<input type="button" OnClick="delCategory(${data[0][0]});" value="delete Category">`;
                document.getElementById("content").appendChild(itemWrapper);
        }
    });
}

//обновляем заказ
function updateOrder(id)
{
$.ajax({
        type: 'POST',
        url: '/ajax',
        cache: false,
        dataType: 'json',
        data: {'id':id, 'mode':"UpdateOrder"},
        success: function(data){
            document.getElementById(`OrderStatus${id}`).innerHTML = "выполнено";
        }
    });
}

//обновляем заказ
function emptyBasket()
{
$.ajax({
        type: 'POST',
        url: '/ajax',
        cache: false,
        dataType: 'json',
        data: {'mode':"EmptyBasket"},
        success: function(data){
            document.getElementById("basketCount").innerHTML = "0";
        }
    });
}

//обновляет товар
function editItem()
{
var name  = document.getElementById("productName").value;
var price  = document.getElementById("productPrice").value;
var newItem  = document.getElementById("new").value;
var sale  = document.getElementById("sale").value;
var category = document.getElementById("category").value;
$.ajax({
        type: 'POST',
        url: '/ajax',
        cache: false,
        dataType: 'json',
        data: {'category':category, 'name':name, 'price':price, 'new':newItem, 'sale':sale, 'mode':"editItem"},
        success: function(data){

        }
    });
}
//удаляет категорию
function delCategory(id)
{
$.ajax({
        type: 'POST',
        url: '/ajax',
        cache: false,
        dataType: 'json',
        data: {'id':id, 'mode':"DelCategory"},
        success: function(data){
            document.getElementById(`itemsOutput${id}`).remove();
        }
    });
}
//выводим список категорий
/*function listCategorys()
{
$.ajax({
        type: 'POST',
        url: '/ajax',
        cache: false,
        dataType: 'json',
        data: {'mode':"GetCategorys"},
        success: function(data){
            document.getElementById("content").innerHTML = "";
            for ( var i = 0; i < data.length; i++ ) {
                var itemWrapper = document.createElement('category');
                itemWrapper.className = "itemInList";
                itemWrapper.id = `itemsOutput${data[i][0]}`;
                itemWrapper.innerHTML = `${data[i][1]}<input type="button" OnClick="delCategory(${data[i][0]});" value="delete Category">`;
                document.getElementById("content").appendChild(itemWrapper);
            }
        }
    });
}*/

//выводим список товаров
function listItems()
{
$.ajax({
        type: 'POST',
        url: '/ajax',
        cache: false,
        dataType: 'json',
        data: {'mode':"GetItems"},
        success: function(data){
            document.getElementById("content").innerHTML = "";
            var itemTable = document.createElement('table');
            itemTable.id = 'itemTable';
            itemTable.border = '1';
            document.getElementById('content').appendChild(itemTable);

            for ( var i = 0; i < data.length; i++ ) {
                itemTable.appendChild(document.createElement('tr'));
                itemTable.lastChild.id = `itemsOutput${data[i][0]}`;
                itemTable.lastChild.innerHTML = `<td>${data[i][0]}</td><td>${data[i][1]}</td><td>${data[i][2]}</td><td>${data[i][3]}</td><td>${data[i][4]}</td>`;
            }
        }
    });
}

//если документ загрузился - поехали
$(document).ready(function(){

$("#categoryAll").on("click", function() {
    categoryGlobal = 0;
    ajaxPostFunc(0, 1);
});
$("#categoryWoman").on("click", function() {
    categoryGlobal = 2;
    ajaxPostFunc(2, 1);
});
$("#categoryMan").on("click", function() {
    categoryGlobal = 1;
    ajaxPostFunc(1, 1);
});
$("#categoryChildren").on("click", function() {
    categoryGlobal = 3;
    ajaxPostFunc(3, 1);
});
$("#categoryAcc").on("click", function() {
    categoryGlobal = 4;
    ajaxPostFunc(4, 1);
});

$("#categoryAllItemList").on("click", function() {
    categoryGlobal = 0;
    ajaxItemlist(0, 1);
});
$("#categoryWomanItemList").on("click", function() {
    categoryGlobal = 2;
    ajaxItemlist(2, 1);
});
$("#categoryManItemList").on("click", function() {
    categoryGlobal = 1;
    ajaxItemlist(1, 1);
});
$("#categoryChildrenItemList").on("click", function() {
    categoryGlobal = 3;
    ajaxItemlist(3, 1);
});
$("#categoryAccItemList").on("click", function() {
    categoryGlobal = 4;
    ajaxItemlist(4, 1);
});

//обработка комбо
$("#orderby").change(function(){
   var value = $(this).val();
   orderbyGlobal = value;
        /*$.ajax({
                type: 'POST',
                url: '/ajax',
                cache: false,
                dataType: 'json',
                data: {'choice':value},
                success: function(data){
                  orderbyGlobal = value;
                }
            });*/
});

$("#orderbydesc").change(function(){
   var value = $(this).val();
   orderbyDescGlobal = value;
});

$("#new").click(function() {
    if(this.checked) {
      itemnewGlobal = 1;
    } else {
      itemnewGlobal = 0;
    }
});
$("#sale").click(function() {
    if(this.checked) {
      itemsaleGlobal = 1;
    } else {
      itemsaleGlobal = 0;
    }
});
$("#searchbutton").click(function() {
    ajaxPostFunc(categoryGlobal, 1);
});

$( "#lowprice" ).val("100 руб.");
$( "#higthprice" ).val("9000 руб.");

$( "#slider-range" ).slider({
    range: true,
    min: 100,
    max: 9000,
    values: [ 100, 9000 ],
    slide: function( event, ui ) {
        $( "#lowprice" ).val(ui.values[0]+" руб.");
        $( "#higthprice" ).val(ui.values[1]+" руб.");
        lowpriceGlobal = ui.values[0];
        higthpriceGlobal = ui.values[1];
    }
});

//валидация текстового поля
/*
  $.fn.checkRequired = function() {
    var res=false;
      if ($(this).val()=="") {
        $(this).after('<span class="error">This field is required</span>');
        res=true;
      }
      setTimeout(function(){$(".error").remove();},800);
    return res;
  }*/

//валидация формы

 $.fn.checkRequired = function() {
    var res=true;
    $(this).find(":input[required]").each(function(){
      var that=this;
      if ($(this).val()=="") {
        $(this).after('<span class="error">This field is required</span>');
        res=false;
      }
      setTimeout(function(){$(".error").remove();},700);
    });
    return res;
  }

//обработка кнопки добавления товара
/*$("#addItemButton").on("click",function(){
    if ($("#addItemForm").checkFormRequired()) {
        $(this).attr("disable",true);
    } else {
        $(this).attr("disable",true);
        addItem();
    }
});*/

//изменение товара
$("#editItemButton").click(function(e){
        if ($("#editItemForm").checkRequired()) {
        e.preventDefault();
        var $button=$(this);
        var url="/ajax";
        $button.attr("disable",true);

        var $that = $('#editItemForm'),
        formData = new FormData($that.get(0));
        $.ajax({
            url: url,
            type: "POST",
            contentType: false,
            processData: false,
            data: formData,
            dataType: 'json',
            success: function(){
                $that.hide();
                $("#successPopUp").removeAttr("hidden");
            },
            error: function () {
                $that.hide();
                $("#errorPopUp").removeAttr("hidden");
            }
        });
        }
        return false;
      });

//добавление товара
$("#FileUpload1").click(function(e){
        if ($("#addItemForm").checkRequired()) {
        e.preventDefault();
        var $button=$(this);
        var url="/ajax";
        $button.attr("disable",true);

        var $that = $('#addItemForm'),
        formData = new FormData($that.get(0));
        $.ajax({
            url: url,
            type: "POST",
            contentType: false,
            processData: false,
            data: formData,
            dataType: 'json',
            success: function(){
                $that.hide();
                $("#successPopUp").removeAttr("hidden");
            },
            error: function () {
                $that.hide();
                $("#errorPopUp").removeAttr("hidden");
            }
        });
        }
        return false;
      });

//добавление заказа
$("#addOrderButton").click(function(e)
{
    if ($("#addOrderForm").checkRequired()) {
        e.preventDefault();
        var $button=$(this);
        var url="/ajax";
        $button.attr("disable",true);
        var $that = $('#addOrderForm'),
        formData = new FormData($that.get(0));
        $.ajax({
            url: url,
            type: "POST",
            contentType: false,
            processData: false,
            data: formData,
            dataType: 'json',
            success: function(){
                $that.hide();
                $("#orderList").hide();
                $("#successPopUp").removeAttr("hidden");
                emptyBasket();
            },
            error: function () {
                $('#addOrderForm').hide();
                $('#orderList').hide();
                $("#errorPopUp").removeAttr("hidden");
            }
        });
    }
    return false;
});

$("#addToBasket").click(function(e){
        e.preventDefault();
        var $button=$(this);
        var url="/ajax";
        $button.attr("disable",true);

        var $that = $('#addBusketForm'),
        formData = new FormData($that.get(0));
        $.ajax({
            url: url,
            type: "POST",
            contentType: false,
            processData: false,
            data: formData,
            dataType: 'json',
            success: function(data){
                document.getElementById("basketCount").innerHTML = data;
            }
        });

        return false;
      });

$('#deliveryType').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if (valueSelected == 1) {
        document.getElementById("deliveryAdd").innerHTML = "При сумме заказа менее 2000 руб. доставка курьером оплачивается дополнительно - 280 руб.";
    } else {
        document.getElementById("deliveryAdd").innerHTML = "";
    }
});


//---------------------end---------
});
