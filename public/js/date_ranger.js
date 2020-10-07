let searchParams = new URLSearchParams(window.location.search)
  let dateInterval = searchParams.get('from-to');
  let start = moment().subtract(29, 'days');
  let end = moment();

  if (dateInterval) {
      dateInterval = dateInterval.split(' - ');
      start = dateInterval[0];
      end = dateInterval[1];
  }

  $('#date_filter').daterangepicker({
      "showDropdowns": true,
      "showWeekNumbers": true,
      "alwaysShowCalendars": true,
      startDate: start,
      endDate: end,
      locale: {
          format: 'DD-MM-YYYY',
          firstDay: 1,
      },
      ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
          'This Year': [moment().startOf('year'), moment().endOf('year')],
          'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
          'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
      }
  });
