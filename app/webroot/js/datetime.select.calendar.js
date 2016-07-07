$('#datetimepicker').datetimepicker({
    
    dayOfWeekStart: 1,
    step:5,
    maxDate: '-1970/01/01',
    
    i18n:{
              en:{ // English
                        months: [
                                "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
                        ],
                        dayOfWeek: [
                                "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"
                        ]
                },
               ja:{ // Japanese
                        months: [
                                "1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"
                        ],
                        dayOfWeek: [
                                "日", "月", "火", "水", "木", "金", "土"
                        ]
                }, 
           },
     lang:'ja',
  }
);