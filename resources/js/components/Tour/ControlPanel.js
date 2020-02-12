import React, { Component } from "react";

import { Card, CardBody, CardTitle } from "reactstrap";
import SortableTree from "react-sortable-tree";

export default class ControlPanel extends Component {
    render() {
        const { itineraries, omitChangeSort } = this.props;

        return (
            <Card className="main-card mb-3">
                <CardBody>
                    <CardTitle>Control Panel</CardTitle>
                    <div style={{ height: "100vh" }}>
                        <SortableTree
                            maxDepth={1}
                            treeData={itineraries}
                            onChange={treeData => omitChangeSort(treeData)}
                        />
                    </div>
                </CardBody>
            </Card>
        );
    }
}
