export const arrayToObject = array =>
  array.reduce((obj, item) => {
    obj[item.id] = item;
    return obj;
  }, {});

// transform to array
export const objectToArray = object => {
  return Object.keys(object).map(objecttKey => object[objecttKey]);
};

// const peopleObject = arrayToObject(peopleArray)
// console.log(peopleObject[idToSelect])
