module.exports = (sequelize, Sequelize) => {
  const Property = sequelize.define("properties", {
    property_name: {
      type: Sequelize.STRING
    },
    address: {
      type: Sequelize.STRING
    },
    city: {
      type: Sequelize.STRING
    },
    country: {
      type: Sequelize.STRING
    },
    minimum_price: {
      type: Sequelize.DECIMAL
    },
    maximum_price: {
      type: Sequelize.DECIMAL
    },
    ready_to_sell: {
      type: Sequelize.INTEGER
    }
  }, {
    timestamps: false
}); 

  return Property;
};