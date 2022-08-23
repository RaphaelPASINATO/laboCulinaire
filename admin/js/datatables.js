$(document).ready(function () {
  $('table.dataTable').DataTable({
    language: {
      url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json'
    },
    "columnDefs": [{
      "targets": 'no-sort',
      "orderable": false,
    }]
  });
});
