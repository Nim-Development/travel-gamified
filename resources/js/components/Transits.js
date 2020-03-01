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
    DropdownToggle,
    Button,
    CardHeader
} from "reactstrap";

import ReactTable from "react-table";

export default class Transits extends Component {
    constructor(props) {
        super(props);
        this.state = {
            transits: props.transits
        };
    }

    newTransit() {
        window.location = window.location.origin + `/transits/new`;
    }

    // Route to single tour
    openTransit(id) {
        window.location = window.location.origin + `/transits/${id}`;
    }

    render() {
        const data = this.state.routes;
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
                                <CardHeader>
                                    <Button
                                        onClick={() => this.newTransit()}
                                        className="brn btn-success"
                                    >
                                        New Transit
                                    </Button>
                                </CardHeader>
                                <CardBody>
                                    <ReactTable
                                        data={data}
                                        columns={[
                                            {
                                                columns: [
                                                    {
                                                        Header: "Id",
                                                        accessor: "id"
                                                    },
                                                    {
                                                        Header: "Name",
                                                        accessor: "name"
                                                    },
                                                    {
                                                        Header: "Duration",
                                                        accessor: "duration"
                                                    },
                                                    {
                                                        Header: "From",
                                                        accessor: "from",
                                                        Cell: row =>
                                                            !row.original.from
                                                                ? ""
                                                                : row.original
                                                                      .from.name
                                                    },
                                                    {
                                                        Header: "To",
                                                        accessor: "to",
                                                        Cell: row =>
                                                            !row.original.to
                                                                ? ""
                                                                : row.original
                                                                      .to.name
                                                    },
                                                    {
                                                        Header: "Created At",
                                                        accessor: "created_at"
                                                    },
                                                    {
                                                        Header: "Updated At",
                                                        accessor: "updated_at"
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
                                                                                this.openTransit(
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

if (document.getElementById("transits")) {
    const element = document.getElementById("transits");
    const transits = JSON.parse(element.getAttribute("transits")); // Data passed in from blade view
    ReactDOM.render(<Transits transits={transits} />, element);
}
