const { authJwt } = require("../middleware");
const properties = require("../controllers/property.controller");

module.exports = function(app) {
  app.use(function(req, res, next) {
    res.header(
      "Access-Control-Allow-Headers",
      "x-access-token, Origin, Content-Type, Accept"
    );
    next();
  });

  app.get("/properties/", [authJwt.verifyToken], properties.findAll);

  app.post("/properties/", [authJwt.verifyToken], properties.create);
  
    // Retrieve all Properties
  app.get("/properties/", [authJwt.verifyToken, authJwt.isAdmin], properties.findAll);  
    
    // Retrieve a single Property with id
  app.get("/properties/:id", [authJwt.verifyToken, authJwt.isAdmin], properties.findOne);
  
    // Update a Property with id
  app.put("/properties/:id", [authJwt.verifyToken, authJwt.isAdmin], properties.update);
  
    // Delete a Property with id
  app.delete("/properties/:id", [authJwt.verifyToken, authJwt.isAdmin], properties.delete);
  
    // Delete all Properties
  app.delete("/properties/", [authJwt.verifyToken, authJwt.isAdmin], properties.deleteAll);

  
};
