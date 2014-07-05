$(function () {
   jQuery.extend(jQuery.mobile.datebox.prototype.options, {
      'dateFormat': 'dd/MM/YYYY',
      'headerFormat': 'dd/MM/YYYY',
      'setDateButtonLabel': 'Aceptar',
      'fieldsOrder': ["d","m", "y"],
      'noButtonFocusMode': 'true'
        
   }); 
});