Noty.overrideDefaults({
  	callbacks: {
    	onTemplate: function() {
    		const twTheme = { 
    			twDanger : 'red',
    			twSuccess : 'green',
    			twInfo : 'blue', 
    			twWarnning : 'yellow' 
    		};

      		if (this.options.type === 'twDanger' || this.options.type === 'twSuccess' || this.options.type === 'twInfo' || this.options.type === 'twWarning') {
        		this.barDom.innerHTML = `<div class="p-3 bg-white rounded-md shadow-md">
					<div class="flex items-start">
						<div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-${twTheme[this.options.type]}-100">
							<svg class="h-6 w-6 text-${twTheme[this.options.type]}-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		            			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
		          			</svg>
						</div>
						<div class="px-2">
							<div class="text-sm font-medium">${this.options.title}</div>
							<div class="text-xs">${this.options.text}</div>
						</div>
					</div>
					<div class="noty_progressbar bg-${twTheme[this.options.type]}-600"></div>
		        </div>`;
      		}
    	}
  	}
});

Noty.overrideDefaults({
    timeout : 3000,
    progressBar : true
});
