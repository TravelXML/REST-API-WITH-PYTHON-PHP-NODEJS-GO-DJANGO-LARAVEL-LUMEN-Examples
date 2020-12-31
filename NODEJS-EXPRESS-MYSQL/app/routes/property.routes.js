module.exports = app => {
  const properties = require("../controllers/property.controller.js");

  // Create a new Customer
  app.post("/properties", properties.create);

  // Retrieve all Customers
  app.get("/properties", properties.findAll);

  // Retrieve a single Customer with propertyId
  app.get("/properties/:propertyId", properties.findOne);

  // Update a Customer with propertyId
  app.put("/properties/:propertyId", properties.update);

  // Delete a Customer with propertyId
  app.delete("/properties/:propertyId", properties.delete);

  // Create a new Customer
  app.delete("/properties", properties.deleteAll);
};
