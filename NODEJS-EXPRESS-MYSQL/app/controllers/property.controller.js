const Property = require("../models/property.model.js");

// Create and Save a new Property
exports.create = (req, res) => {
  // Validate request
  if (!req.body) {
    res.status(400).send({
      message: "Content can not be empty!"
    });
  }

  // Create a Property
  const property = new Property({
    property_name: req.body.property_name,
    address: req.body.address,
    city: req.body.city,
    country: req.body.country,
    type: req.body.type,
    minimum_price: req.body.minimum_price,
    maximum_price: req.body.maximum_price,
    ready_to_sell:req.body.ready_to_sell
  });

  console.log(req.body);

  // Save Property in the database
  Property.create(property, (err, data) => {
    if (err)
      res.status(500).send({
        message:
          err.message || "Some error occurred while creating the Property."
      });
    else res.send(data);
  });
};

// Retrieve all Properties from the database.
exports.findAll = (req, res) => {
  Property.getAll((err, data) => {
    if (err)
      res.status(500).send({
        message:
          err.message || "Some error occurred while retrieving properties."
      });
    else res.send(data);
  });
};

// Find a single Property with a propertyId
exports.findOne = (req, res) => {
  Property.findById(req.params.propertyId, (err, data) => {
    if (err) {
      if (err.kind === "not_found") {
        res.status(404).send({
          message: `Not found Property with id ${req.params.propertyId}.`
        });
      } else {
        res.status(500).send({
          message: "Error retrieving Property with id " + req.params.propertyId
        });
      }
    } else res.send(data);
  });
};

// Update a Property identified by the propertyId in the request
exports.update = (req, res) => {
  // Validate Request
  if (!req.body) {
    res.status(400).send({
      message: "Content can not be empty!"
    });
  }

  console.log(req.body);

  Property.updateById(
    req.params.propertyId,
    new Property(req.body),
    (err, data) => {
      if (err) {
        if (err.kind === "not_found") {
          res.status(404).send({
            message: `Not found Property with id ${req.params.propertyId}.`
          });
        } else {
          res.status(500).send({
            message: "Error updating Property with id " + req.params.propertyId
          });
        }
      } else res.send(data);
    }
  );
};

// Delete a Property with the specified propertyId in the request
exports.delete = (req, res) => {
  Property.remove(req.params.propertyId, (err, data) => {
    if (err) {
      if (err.kind === "not_found") {
        res.status(404).send({
          message: `Not found Property with id ${req.params.propertyId}.`
        });
      } else {
        res.status(500).send({
          message: "Could not delete Property with id " + req.params.propertyId
        });
      }
    } else res.send({ message: `Property was deleted successfully!` });
  });
};

// Delete all Properties from the database.
exports.deleteAll = (req, res) => {
  Property.removeAll((err, data) => {
    if (err)
      res.status(500).send({
        message:
          err.message || "Some error occurred while removing all properties."
      });
    else res.send({ message: `All Properties were deleted successfully!` });
  });
};
