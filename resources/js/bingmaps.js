document.addEventListener('DOMContentLoaded', () => {
  import('bingmaps').then((bingmaps) => {
    const map = new bingmaps.Map('#mapContainer', {
      credentials: 'ArsJvg3CxexkzID0WFmDeNVUeS6CJrrAk6EdREVlNL_XHfxWCqrOpZwpUV-mfdF7',
    });

    // Add your map initialization code here
  });
});
