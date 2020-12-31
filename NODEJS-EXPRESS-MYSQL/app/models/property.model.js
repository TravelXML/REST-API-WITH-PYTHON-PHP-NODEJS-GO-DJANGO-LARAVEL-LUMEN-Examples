const sql = require("./db.js");

// constructor
const Property = function(property) {
  this.property_name = property.property_name,
  this.address = property.address,
  this.city = property.city,
  this.country = property.country,
  this.type = property.type,
  this.minimum_price = property.minimum_price,
  this.maximum_price = property.maximum_price,
  this.ready_to_sell = property.ready_to_sell
};

Property.create = (newProperty, result) => {
  sql.query("INSERT INTO properties SET ?", newProperty, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(err, null);
      return;
    }

    console.log("created property: ", { id: res.insertId, ...newProperty });
    result(null, { id: res.insertId, ...newProperty });
  });
};

Property.findById = (propertyId, result) => {
  sql.query(`SELECT * FROM properties WHERE id = ${propertyId}`, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(err, null);
      return;
    }

    if (res.length) {
      console.log("found property: ", res[0]);
      result(null, res[0]);
      return;
    }

    // not found Property with the id
    result({ kind: "not_found" }, null);
  });
};

Property.getAll = result => {
  sql.query("SELECT * FROM properties", (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(null, err);
      return;
    }

    console.log("properties: ", res);
    result(null, res);
  });
};

Property.updateById = (id, property, result) => {
  sql.query(
    "UPDATE properties SET property_name = ?, address = ?, city = ?, country = ?, minimum_price = ?, maximum_price = ?, ready_to_sell = ? WHERE id = ?",
    [property.property_name, property.address, property.city,property.country, property.minimum_price,property.maximum_price, property.ready_to_sell, id],
    (err, res) => {
      if (err) {
        console.log("error: ", err);
        result(null, err);
        return;
      }

      if (res.affectedRows == 0) {
        // not found Property with the id
        result({ kind: "not_found" }, null);
        return;
      }

      console.log("updated property: ", { id: id, ...property });
      result(null, { id: id, ...property });
    }
  );
};

Property.remove = (id, result) => {
  sql.query("DELETE FROM properties WHERE id = ?", id, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(null, err);
      return;
    }

    if (res.affectedRows == 0) {
      // not found Property with the id
      result({ kind: "not_found" }, null);
      return;
    }

    console.log("deleted property with id: ", id);
    result(null, res);
  });
};

Property.removeAll = result => {
  sql.query("DELETE FROM properties", (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(null, err);
      return;
    }

    console.log(`deleted ${res.affectedRows} properties`);
    result(null, res);
  });
};

module.exports = Property;
