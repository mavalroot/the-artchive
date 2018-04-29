function guardar(nombre) {
  var columns = [
        {title: "Título", dataKey: "title"},
        {title: "Contenido", dataKey: "content"}
    ];

  var data = [];

  let tr = $('table tbody tr');
  $.each(tr, function(index, value) {
      data.push({title: value.cells[0].innerText, content: value.cells[1].innerText})
  });

  var doc = new jsPDF('p', 'pt');

  doc.autoTableSetDefaults({
        addPageContent: function(data) {
            doc.setFontSize(20);
            doc.text(nombre, data.settings.margin.left, 40);
        },
        margin: {top: 60}
    });

  doc.autoTable(columns, data, {
      border: true,
        showHeader: 'never',
        columnStyles: {
            title: {fillColor: [41, 128, 185], textColor: 255, fontStyle: 'bold'},
            content: {columnWidth: 'auto'}
        },
        styles: {
            overflow: 'linebreak',
            columnWidth: 'wrap',
            lineWidth: '1',
            lineColor: '0',
            textColor: '0'},
    });
  doc.save(nombre + '.pdf');
}

$(document).ready(function() {
    $('#export').on('click', function() {
        let nombre = $(this).data('name');
        guardar(nombre);
    });
});
