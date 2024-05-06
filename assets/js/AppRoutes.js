$(document).ready(function() {
    var app = $.jQuerySPApp({ defaultView: "index22" }); // initialize
  
    app.route({
      view: 'index22',
      load: 'index22.html',
      onCreate: function() {
        // Add any code to run when the route is created
      },
      onReady: function() {
        // Add any code to run when the route is ready
      }
    });
  
    app.route({
      view: 'hatchback',
      load: 'hatchback.html',
      onCreate: function() {
        // Add any code to run when the route is created
      },
      onReady: function() {
        // Add any code to run when the route is ready
      }
    });
  
    app.route({
      view: 'Sedan23',
      load: 'Sedan23.html',
      onCreate: function() {
        // Add any code to run when the route is created
      },
      onReady: function() {
        // Add any code to run when the route is ready
      }
    });
  
    app.route({
      view: 'conditions',
      load: 'conditions.html',
      onCreate: function() {
        // Add any code to run when the route is created
      },
      onReady: function() {
        // Add any code to run when the route is ready
      }
    });
  
    app.route({
      view: 'user',
      load: 'user.html',
      onCreate: function() {
        // Add any code to run when the route is created
      },
      onReady: function() {
        // Add any code to run when the route is ready
      }
    });
  
    app.route({
      view: 'volkswagen7detail',
      load: 'volkswagen7detail.html',
      onCreate: function() {
        // Add any code to run when the route is created
      },
      onReady: function() {
        // Add any code to run when the route is ready
      }
    });
  
    app.route({
      view: 'reservation',
      load: 'reservation.html',
      onCreate: function() {
        // Add any code to run when the route is created
      },
      onReady: function() {
        // Add any code to run when the route is ready
      }
    });
  
    app.route({
      view: 'SkodaDetail',
      load: 'SkodaDetail.html',
      onCreate: function() {
        // Add any code to run when the route is created
      },
      onReady: function() {
        // Add any code to run when the route is ready
      }
    });
  
    // Run the app after defining all routes
    app.run();
  });
  