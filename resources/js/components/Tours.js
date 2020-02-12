import React, { Component, Fragment } from "react";
import ReactDOM from "react-dom";

import ReactCSSTransitionGroup from "react-addons-css-transition-group";
import PageTitle from "./Layout/AppMain/PageTitle";

import {
    Row,
    Col,
    Card,
    CardBody,
    UncontrolledButtonDropdown,
    DropdownItem,
    DropdownMenu,
    DropdownToggle
} from "reactstrap";
import ReactTable from "react-table";
import avatar2 from "./assets/utils/images/flags/vietnam-flag-small.png";

class Tours extends Component {
    constructor(props) {
        super(props);
        this.state = {
            tours: props.tours
        };
    }

    // Route to single tour
    openTour(id) {
        window.location = window.location.origin + `/tours/${id}`;
    }

    render() {
        const data = this.state.tours;
        return (
            <Fragment>
                <ReactCSSTransitionGroup
                    component="div"
                    transitionName="TabsAnimation"
                    transitionAppear={true}
                    transitionAppearTimeout={0}
                    transitionEnter={false}
                    transitionLeave={false}
                >
                    <PageTitle
                        heading="Practice Dashboard"
                        subheading="This is an example dashboard where one can play around with different components."
                        icon="pe-7s-car icon-gradient bg-mean-fruit"
                        enablePageTitleActions
                    />
                    <Row>
                        <Col md="12">
                            <Card className="main-card mb-3">
                                <CardBody>
                                    <ReactTable
                                        data={data}
                                        columns={[
                                            {
                                                columns: [
                                                    {
                                                        Header: "Name",
                                                        accessor: "name",
                                                        Cell: row => (
                                                            <div>
                                                                <div className="widget-content p-0">
                                                                    <div className="widget-content-wrapper">
                                                                        <div className="widget-content-left mr-3">
                                                                            <div className="widget-content-left">
                                                                                <img
                                                                                    width={
                                                                                        52
                                                                                    }
                                                                                    className="rounded-circle"
                                                                                    src={
                                                                                        avatar2
                                                                                    }
                                                                                    alt=""
                                                                                />
                                                                            </div>
                                                                        </div>
                                                                        <div className="widget-content-left flex2">
                                                                            <div className="widget-heading">
                                                                                {
                                                                                    row.value
                                                                                }
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        )
                                                    },
                                                    {
                                                        Header: "Duration",
                                                        accessor: "duration"
                                                    },
                                                    {
                                                        Header: "Created At",
                                                        accessor: "created_at"
                                                    }
                                                ]
                                            },
                                            {
                                                columns: [
                                                    {
                                                        Header: "Actions",
                                                        accessor: "actions",
                                                        Cell: row => (
                                                            <div className="d-block w-100 text-center">
                                                                <UncontrolledButtonDropdown>
                                                                    <DropdownToggle
                                                                        caret
                                                                        className="btn-icon btn-icon-only btn btn-link"
                                                                        color="link"
                                                                    >
                                                                        <i className="lnr-menu-circle btn-icon-wrapper" />
                                                                    </DropdownToggle>
                                                                    <DropdownMenu className="rm-pointers dropdown-menu-hover-link">
                                                                        <DropdownItem
                                                                            header
                                                                        >
                                                                            Action
                                                                        </DropdownItem>
                                                                        <DropdownItem
                                                                            onClick={() =>
                                                                                this.openTour(
                                                                                    row
                                                                                        .original
                                                                                        .id
                                                                                )
                                                                            }
                                                                        >
                                                                            <i className="dropdown-icon lnr-inbox">
                                                                                {" "}
                                                                            </i>
                                                                            <span>
                                                                                Details
                                                                            </span>
                                                                        </DropdownItem>
                                                                        <DropdownItem>
                                                                            <i className="dropdown-icon lnr-file-empty">
                                                                                {" "}
                                                                            </i>
                                                                            <span>
                                                                                Delete
                                                                            </span>
                                                                        </DropdownItem>
                                                                        <DropdownItem
                                                                            divider
                                                                        />
                                                                        <DropdownItem>
                                                                            <i className="dropdown-icon lnr-picture">
                                                                                {" "}
                                                                            </i>
                                                                            <span>
                                                                                Blabla
                                                                            </span>
                                                                        </DropdownItem>
                                                                    </DropdownMenu>
                                                                </UncontrolledButtonDropdown>
                                                            </div>
                                                        )
                                                    }
                                                ]
                                            }
                                        ]}
                                        defaultPageSize={10}
                                        className="-striped -highlight"
                                    />
                                </CardBody>
                            </Card>
                        </Col>
                    </Row>
                </ReactCSSTransitionGroup>
            </Fragment>
        );
    }
}

if (document.getElementById("tours")) {
    const element = document.getElementById("tours");
    const tours = JSON.parse(element.getAttribute("tours")); // Data passed in from blade view
    ReactDOM.render(<Tours tours={tours} />, element);
}
