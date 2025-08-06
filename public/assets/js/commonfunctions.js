function isIndianCurrency(val) {
    var testcase = /^\$?\-?([1-9]{1}[0-9]{0,2}(\,\d{3})*(\.\d{0,2})?|[1-9]{1}\d{0,}(\.\d{0,2})?|0(\.\d{0,2})?|(\.\d{1,2}))$|^\-?\$?([1-9]{1}\d{0,2}(\,\d{3})*(\.\d{0,2})?|[1-9]{1}\d{0,}(\.\d{0,2})?|0(\.\d{0,2})?|(\.\d{1,2}))$|^\(\$?([1-9]{1}\d{0,2}(\,\d{3})*(\.\d{0,2})?|[1-9]{1}\d{0,}(\.\d{0,2})?|0(\.\d{0,2})?|(\.\d{1,2}))\)$/;
    return testcase.test(val); //currency validation including , (commas seperator)
}

function isNumber(val) {
    var testcase = /[0-9.]+/;
    return testcase.test(val); //return true if it is natural numbers
}

function formatNumber(id) {
    var num = $('#' + id).val();
    var n1, n2;
    num = num + '' || '';
    // works for integer and floating as well
    n1 = num.split('.');
    n2 = n1[1] || null;
    n1 = n1[0].replace(/(\d)(?=(\d\d)+\d$)/g, "$1,");
    num = n2 ? n1 + '.' + n2 : n1 + '.00';
    $('#' + id).val(num);
}
/* RETURN DATE IN PROPER FORMAT AFTER RETRIEVAL FROM DATABASE ::*/
function getProperDate(data) {
    var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    var bday = new Date(parseInt(data.replace("/Date(", "").replace(")/", ""), 10));
    var day = bday.getDate() < 10 ? '0' + bday.getDate() : bday.getDate();
    return day + "-" + m_names[bday.getMonth()] + "-" + bday.getFullYear()
}
/* RETURN DATE IN PROPER FORMAT AFTER RETRIEVAL FROM DATABASE ::*/
function getDatepickerDate(data) {
    var m_names = new Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
    var bday = new Date(parseInt(data.replace("/Date(", "").replace(")/", ""), 10));
    var day = bday.getDate() < 10 ? '0' + bday.getDate() : bday.getDate();
    return bday.getFullYear() + "-" + m_names[bday.getMonth()] + "-" + day
}

function getCurrentDateinProperFormat() {
    var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    var dt = new Date();
    return dt.getDate() + '-' + m_names[dt.getMonth()] + '-' + dt.getFullYear();


}

/* FOR Indian Currency*/
/*TO REMOVE COMMAS ON FOCUS */
function currencyClick(id) {
    var a = $('#' + id).val();
    //a=a.replace(/.00/g,'');
    a = a.replace(/\,/g, '');
    $('#' + id).val(a);
    $('#' + id).select();
}
/*TO GET CURRENCY WITHOUT COMMAS*/
function getCurrencyValue(currencyWithComma) {
    //currencyWithComma=currencyWithComma.replace(/.00/g,'');
    try {
        currencyWithComma = currencyWithComma.replace(/\,/g, '');
    } catch (ex) {
        currencyWithComma = 0.0;
    }
    return currencyWithComma;

}
/*TO CONVERT TO INDIAN CURRENCY ON LOSE FOCUS :: CALLING A FUNCTION*/
function currencyBlur(id) {
    var formattedCurrency = formatCurrency($('#' + id).val());
    var res = indianCurrency(formattedCurrency);
    $('#' + id).val(res);
}
/*TO FORMAT NUMBER TO FLOATING POINT :: */
function formatCurrency(amount) {
    var i = parseFloat(amount);
    if (isNaN(i)) {
        i = 0.00;
    }
    var minus = '';
    if (i < 0) {
        minus = '-';
    }
    i = Math.abs(i);
    i = parseInt((i + .005) * 100);
    i = i / 100;
    s = new String(i);
    if (s.indexOf('.') < 0) {
        s += '.00';
    }
    if (s.indexOf('.') == (s.length - 2)) {
        s += '0';
    }
    s = minus + s;
    return s;
}
/*TO CONVERT TO INDIAN CURRENCY WITH COMMAS*/
function indianCurrency(val) {
    var x = val;
    x = x.toString();
    var afterPoint = '';
    if (x.indexOf('.') > 0)
        afterPoint = x.substring(x.indexOf('.'), x.length);
    x = Math.floor(x);
    x = x.toString();
    var lastThree = x.substring(x.length - 3);
    var otherNumbers = x.substring(0, x.length - 3);
    if (otherNumbers != '')
        lastThree = ',' + lastThree;
    if (afterPoint == '') { afterPoint = '.00' }
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
    return res;
}
/*TO INPUT DIGITS ONLY */
function numberonly(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if (number.length > 1 && charCode == 46) {
        return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if (caratPos > dotPos && dotPos > -1 && (number[1].length > 1)) {
        return false;
    }
    return true;
}
/*TO ALLOW ONLY 2 DIGIST AFTER DECIMAL POINT*/
function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate()
        r.moveEnd('character', o.value.length)
        if (r.text == '') return o.value.length
        return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
}
/*END INDIAN CURRENCY*/

/*
     ==================   DATE FUNCTIONS =================================

*/

function getcurrentDate() {
    var dt = new Date();
    return dt.getDate() + '-' + (dt.getMonth() + 1) + '-' + dt.getFullYear();
}


function errorNotification(title, message) {
    window.createNotification({
        closeOnClick: true,
        displayCloseButton: true,
        positionClass: "nfc-bottom-right",
        showDuration: 5000,
        theme: "error"
    })({
        title: title,
        message: message
    });
}

function successNotification(title, message) {
    window.createNotification({
        closeOnClick: true,
        displayCloseButton: true,
        positionClass: "nfc-bottom-right",
        showDuration: 5000,
        theme: "success"
    })({
        title: title,
        message: message
    });
}



function loadSelect(id, data,isSelect=true,isAll=false) {

    var text="";
    if (data.length == 0) {
        text += "<option disabled>No Data</option>";
    } else {
        if (isSelect){
            if (isAll)
                text += "<option value='%'> All </option>";
            else
                text += "<option value=-1> Select </option>";
        }

        for (let i = 0; i < data.length; i++) {
            text += '<option value="' + data[i][Object.keys(data[i])[0]] + '">' + data[i][Object.keys(data[i])[1]] + '</option>';
        }
    }
    $(id).html(text);
}



//var csv is the CSV file with headers
function csvJSON(csv){

    var lines=csv.split("\r\n");

    var result = [];

    // NOTE: If your columns contain commas in their values, you'll need
    // to deal with those before doing the next step
    // (you might convert them to &&& or something, then covert them back later)
    // jsfiddle showing the issue https://jsfiddle.net/
    var headers = lines[0].split(",");

    for(var i=1;i<lines.length-1;i++){

        var obj = {};
        var currentline=lines[i].split(",");

        for(var j=0;j<headers.length;j++){
            obj[headers[j]] = currentline[j];
        }

        result.push(obj);

    }

    return result; //JavaScript object
    // return JSON.stringify(result); //JSON
}