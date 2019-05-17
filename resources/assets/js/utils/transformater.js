'use strict';

import _ from 'lodash';

export default class Transformater
{
  constructor(data) {
    this.data = data.map(function(el) {
        el.id = parseInt(el.id);
        el.parent = parseInt(el.parent);
        return el;
    }).sort(function (a, b) {
      return (a.parent > b.parent) ?
        1 :
        (a.parent < b.parent ? -1 : 0)
    });
  }

  tree(array, parent, tree) {
    let that = this,
      items = null;

    array = typeof tree !== 'undefined' ? tree : _.clone(that.data);
    tree = typeof tree !== 'undefined' ? tree : [];
    parent = typeof parent !== 'undefined' ? parent : { id: 0 };

    items = _.filter( array, (child) => {
        return child.parent == parent.id;
    });

    if (!_.isEmpty( items )) {
      if (!parent.id) {
          tree = items;   
      } else {
          parent['items'] = items;
      }
      _.each(items, child => that.tree( array, child ));                    
    }

    return tree.map(that.sortBy);
  }

  sortBy(struct, order) {
    let that = this;
        struct = typeof struct === 'undefined' ? that.data : struct;
        order  = typeof order !== 'string' ? 'orderID' : order;

    if (!struct.hasOwnProperty('items')) {
        return struct;
    }

    struct.items = struct.items.sort(function (a, b) {
      if (a.hasOwnProperty('items')) {
          a.items = that.sortBy(a, order);
      }

      return (a[order] > b[order]) ?
              1 :
              (a[order] < b[order] ? -1 : 0)
    });

    return struct;
  }
}