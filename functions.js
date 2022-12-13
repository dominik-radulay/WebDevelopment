window.addEventListener('load', function() {
    'use strict';

// definition of constants
const l_form = document.getElementById('orderForm')
const l_paragraphs = document.getElementsByTagName("p");
const l_items = l_form.querySelectorAll('.chosen');
const l_itemsCount = l_items.length;
const l_shippings = l_form.querySelectorAll('input[name=deliveryType]');
const l_shippingsCount = l_shippings.length;
let l_total = 0;

// button triggers
l_form.termsChkbx.onchange = termsread;
l_form.customerType.onchange = inputfields;
l_form.submit.onclick = checkForm;


// When any tickbox is clicked the script run function to calculate the price
for (let t_j = 0; t_j < l_itemsCount; t_j++) {
    l_items[t_j].onchange = calculateTotal;
}

for (let t_j = 0; t_j < l_shippingsCount; t_j++) {
    l_shippings[t_j].onchange = calculateTotal;
}

// function which change terms and conditions text and unlock button
function termsread()
{

  if (l_form.termsChkbx.checked)
      {
    const l_terms = l_form.querySelector('#termsText');
    l_terms.style.color="black";
    l_terms.style.fontWeight = "";
    l_form.submit.disabled = false;
      }
    else {
    const l_terms = l_form.querySelector('#termsText');
    l_terms.style.color= "#FF0000";
    l_terms.style.fontWeight= "bold";
    l_form.submit.disabled = true;
      }
}

// function to calculate the price
function calculateTotal() {
    let vatcalc = 0;
    let shipping = 0;
    l_total = 0;



    for (let t_i = 0; t_i < l_itemsCount; t_i++) {
        const t_item = l_items[t_i];
        const t_checkbox = t_item.querySelector('input[data-price][type=checkbox]');
        if (t_checkbox.checked) l_total= l_total +parseFloat(t_checkbox.dataset.price);
    }

    if (l_total > 0){
    for (let t_i = 0; t_i < l_shippingsCount; t_i++) {
        const t_shippings = l_shippings[t_i];

        if (t_shippings.checked)
        {
          shipping = t_shippings.dataset.price;
          l_total= l_total + parseFloat(shipping);
        }
    }
    }

    l_form.total.value = (l_total.toFixed(2));

}


// function which change input fields based on the customer type
function inputfields()
{
  if (l_form.customerType.value == "ret")
      {
    const l_trdfields = l_form.querySelector('#tradeCustDetails');
    const l_retfields = l_form.querySelector('#retCustDetails');
    l_trdfields.style.visibility = "hidden";
    l_retfields.style.visibility = "";
      }
    else if (l_form.customerType.value == "trd") {

      const l_trdfields = l_form.querySelector('#tradeCustDetails');
      const l_retfields = l_form.querySelector('#retCustDetails');
      l_trdfields.style.visibility = "";
      l_retfields.style.visibility = "hidden";
      }
}

// Function to check form
function checkForm(_evt){
  let l_failed = false;
    if (l_form.customerType.value == "") l_failed = true;
    if ((l_form.customerType.value == "ret")&&((l_form.forename.value== "")||(l_form.surname.value== ""))) l_failed = true;
    if ((l_form.customerType.value == "trd")&&(l_form.companyName.value== "")) l_failed = true;
    if (l_total == 0) l_failed = true;

    if (l_failed == true)
    {
      _evt.preventDefault();
      alert("You havent choose a book or filled all required details!");
    }
}


});
