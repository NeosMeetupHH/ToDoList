import qwest from 'qwest';

class ToDoListApi {
    constructor(endpointUri, context = {}) {
        this.endpointUri = endpointUri;
        this.list = context.list || null;
        this.item = context.item || null;
    }

    add(label) {
        if (!this.list) {
            throw new Error('You cannot use add in this context. Please specify a list.');
        }

        return qwest.post(this.endpointUri + 'add', {
            list: this.list,
            label
        });
    }

    update(label) {
        if (!this.item) {
            throw new Error('You cannot use update in this context. Please specify an item.');
        }

        return qwest.post(this.endpointUri + 'add', {
            item: this.item,
            label
        });
    }

    remove() {
        if (!this.item) {
            throw new Error('You cannot use remove in this context. Please specify an item.');
        }

        return qwest.post(this.endpointUri + 'remove', {
            item: this.item
        });
    }

    markAsDone() {
        if (!this.item) {
            throw new Error('You cannot use markAsDone in this context. Please specify an item.');
        }

        return qwest.post(this.endpointUri + 'do', {
            item: this.item
        });
    }

    markAsUnDone() {
        if (!this.item) {
            throw new Error('You cannot use markAsUnDone in this context. Please specify an item.');
        }

        return qwest.post(this.endpointUri + 'undo', {
            item: this.item
        });
    }
}

export default ToDoListApi;