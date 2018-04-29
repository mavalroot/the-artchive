

function guardar(nombre) {
  var doc = new jsPDF('p', 'pt');
  var columns = [
    {title: "Título", dataKey: "title"},
    {title: "Contenido", dataKey: "content"}
  ];
  var data = [];
  let tr = $('table tbody tr');
  $.each(tr, function(index, value) {
      if (index < tr.length-1) {
          data.push({title: value.cells[0].innerText, content: value.cells[1].innerText})
      }
  });
  header(doc, nombre);
  table(doc, columns, data);
  copyright(doc);
  doc.save(nombre + '.pdf');
}

function header(doc, nombre) {
  doc.autoTableSetDefaults({
        addPageContent: function(data) {
            doc.setFontSize(20);
            doc.text(nombre, data.settings.margin.left, 40);
        },
        margin: {top: 60}
    });
}

function copyright(doc) {
    var baseUrl = window.location.origin;
    doc.setFontSize(10);
    doc.text(40,doc.autoTableEndPosY()+20, '© Artchive ' + (new Date()).getFullYear() + ' || ' + baseUrl);
}

function table(doc, columns, data) {
  doc.autoTable(columns, data, {
      border: true,
        showHeader: 'never',
        columnStyles: {
            title: {fillColor: [60, 60, 60], textColor: 255, fontStyle: 'bold'},
            content: {columnWidth: 'auto'}
        },
        styles: {
            overflow: 'linebreak',
            columnWidth: 'wrap'},
    });
}

$(document).ready(function() {
    $('#export').on('click', function() {
        let nombre = $(this).data('name');
        guardar(nombre);
    });
});
