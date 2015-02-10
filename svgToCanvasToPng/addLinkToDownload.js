;(function(window,undefined) {
    'use_strict';

    var scriptUrl = scriptLocation();

    function displayButtonToDownload() {
    	var allSvg = document.getElementsByTagName('svg');
    	if( allSvg != undefined) {
    		var svgLenght = allSvg.length;
    		for (var i = 0; i< svgLenght; i++) {
    			var svgCode = allSvg[i].outerHTML;
    			var index = allSvg[i].getAttribute('id');	
    			if (index != null ) {
    				svgCode += '<a href="'+scriptUrl+'?downloadSvg/' + index + '" onclick="exportToPng(this.href,\''+index+'\');return false;" class="downloadSvg"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAVVJREFUeNqkkr1Og1AUx0+5kMBgdCQxId19CJx8hU7OXZrY1cWmCVsXWImbUxcfwJfAxc00LswsTUMuH9fzR2iktFDjSf5ccjjnx/m4I6UU/cdGbDiXrJvFev12TtJyMrnj44O1AAF69TxPwcoBwRCLHOTqNVSTUlLO7RRF0ft3IQQhFjl47AFlWZLk5CzLegEGC7GHAIE/A5AOAJSmNVWKFiDPc5JMHgJohkGI7QBA/dps6Ho87gUg5mQFz0Fw1u4tyzpeQRRFdOpi1felMtd1OwAdFWBFvh90NmFw3/P5AzmOQ3EcNzPQWwBUoOs6bbcpzWbTyrla+fuS8Q1mmmYzgxbA0Hg9CNrtJNm2XTnxXq1OiRagvgdGtRX0zHoKw/AzSZJUSlUFQ0r9qPH9BnDOBXIxGYd1xbplPXLgy7Ehct/3B6531hSAS4Cbqf7BMIj0W4ABABaX0AP3OHJtAAAAAElFTkSuQmCC" alt="Download this svg" title="Export to png" /></a>';
    				allSvg[i].outerHTML = svgCode;
    			}
    		}
    	}
    }

    /**
     * @return the current script location (without search or hash part of the URL).
     *   eg. http://server.com/zero/?aaaa#bbbb --> http://server.com/zero/
     * @author SebSauvage (http://www.sebsauvage.net)
     */
    function scriptLocation() {
      var scriptLocation = window.location.href.substring(0,window.location.href.length
        - window.location.search.length - window.location.hash.length);
      var hashIndex = scriptLocation.indexOf("#");
      if (hashIndex !== -1) {
        scriptLocation = scriptLocation.substring(0, hashIndex)
      }
      return scriptLocation
    }


    //add to global namespace
    window.onload = displayButtonToDownload;


})(window);  