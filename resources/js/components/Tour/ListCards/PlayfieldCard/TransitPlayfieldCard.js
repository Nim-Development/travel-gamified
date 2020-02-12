import React, { Component } from "react";
import {
    Row,
    Col,
    Card,
    CardBody,
    CardTitle,
    UncontrolledButtonDropdown,
    CardHeader,
    DropdownToggle,
    DropdownMenu,
    DropdownItem
} from "reactstrap";

import { VerticalTimelineElement } from "react-vertical-timeline-component";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faRoad } from "@fortawesome/free-solid-svg-icons";

export default class TransitPlayfieldCard extends Component {
    render() {
        const {
            index,
            id,
            omitDelete,
            name,
            duration,
            type,
            created_at,
            text
        } = this.props;

        return (
            <div>
                <VerticalTimelineElement
                    className="vertical-timeline-item"
                    icon={
                        <div className="timeline-icon border-warning bg-warning">
                            <FontAwesomeIcon
                                icon={faRoad}
                                className="text-white"
                            />
                        </div>
                    }
                >
                    <Card
                        className="main-card mb-3"
                        style={{
                            boxBhadow: "1px 3px 1px red"
                        }}
                    >
                        <CardHeader>
                            {name}
                            <div className="btn-actions-pane-right actions-icon-btn">
                                <UncontrolledButtonDropdown>
                                    <DropdownToggle
                                        className="mb-2 mr-2 btn-icon btn-icon-only"
                                        color="link"
                                    >
                                        <i className="pe-7s-trash btn-icon-wrapper">
                                            {" "}
                                        </i>
                                    </DropdownToggle>
                                    <DropdownMenu className="dropdown-menu-rounded">
                                        <DropdownItem
                                            onClick={() =>
                                                omitDelete(index, id)
                                            }
                                        >
                                            Are u sure?
                                        </DropdownItem>
                                    </DropdownMenu>
                                </UncontrolledButtonDropdown>
                            </div>
                        </CardHeader>
                        <CardBody>
                            <p>
                                Duration: {duration}, Playfield type: {type},
                                Playfield name: {name}, created at: {created_at}
                                {text}
                            </p>
                        </CardBody>
                    </Card>
                </VerticalTimelineElement>
            </div>
        );
    }
}
