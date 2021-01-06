const db = require("../models");
const Property = db.property;
const Op = db.Sequelize.Op;

// Create and Save a new Property
exports.create = (req, res) => {
  // Validate request
  if (!req.body.property_name) {
    res.status(400).send({
      message: "Content can not be empty!"
    });
    return;
  }

  // Create a Property
  const property = {
    property_name: req.body.property_name,
    address: req.body.address,
    city: req.body.city,
    country: req.body.country,
    type: req.body.type,
    minimum_price: req.body.minimum_price,
    maximum_price: req.body.maximum_price,
    ready_to_sell:req.body.ready_to_sell
  };
  // Save Property in the database
  Property.create(property)
    .then(data => {
      res.send(data);
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while creating the Property."
      });
    });
};

// Retrieve all Propertys from the database.
exports.findAll = (req, res) => {
  const property_name = req.query.property_name;
  var condition = property_name ? { title: { [Op.like]: `%${property_name}%` } } : null;

  Property.findAll({ where: condition })
    .then(data => {
      res.send(data);
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while retrieving properties."
      });
    });
};

// Find a single Property with an id
exports.findOne = (req, res) => {
  const id = req.params.id;

  Property.findByPk(id)
    .then(data => {
      res.send(data);
    })
    .catch(err => {
      res.status(500).send({
        message: "Error retrieving Property with id=" + id
      });
    });
};

// Update a Property by the id in the request
exports.update = (req, res) => {
  const id = req.params.id;

  Property.update(req.body, {
    where: { id: id }
  })
    .then(num => {
      if (num == 1) {
        res.send({
          message: "Property was updated successfully."
        });
      } else {
        res.send({
          message: `Cannot update Property with id=${id}. Maybe Property was not found or req.body is empty!`
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        message: "Error updating Property with id=" + id
      });
    });
};

// Delete a Property with the specified id in the request
exports.delete = (req, res) => {
  const id = req.params.id;

  Property.destroy({
    where: { id: id }
  })
    .then(num => {
      if (num == 1) {
        res.send({
          message: "Property was deleted successfully!"
        });
      } else {
        res.send({
          message: `Cannot delete Property with id=${id}. Maybe Property was not found!`
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        message: "Could not delete Property with id=" + id
      });
    });
};

// Delete all Propertys from the database.
exports.deleteAll = (req, res) => {
  Property.destroy({
    where: {},
    truncate: false
  })
    .then(nums => {
      res.send({ message: `${nums} Propertys were deleted successfully!` });
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while removing all properties."
      });
    });
};

// find all published Property
exports.findAllPublished = (req, res) => {
  Property.findAll({ where: { published: true } })
    .then(data => {
      res.send(data);
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while retrieving properties."
      });
    });
};
