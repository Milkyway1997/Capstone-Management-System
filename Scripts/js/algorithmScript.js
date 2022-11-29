class Project {
    constructor(projectID, projectName, projectSize, description, bids) {
        this.projectID = projectID;
        this.projectName = projectName;
        this.projectSize = projectSize;
        this.description = description;
        this.bids = bids;
        this.remaining = projectSize;
    }

    decreaseRemaining(num) {
        this.remaining -= num;
    }
}

class Group {
    constructor(groupID, leader, member1, member2, member3, member4, member5, groupSize) {
        this.groupID = groupID;
        this.groupSize = groupSize;
        this.leader = leader;
        this.member1 = member1;
        this.member2 = member2;
        this.member3 = member3;
        this.member4 = member4;
        this.member5 = member5;
    }
}

class Bid {
    constructor(bidID, groupID, groupSize, projectID, timestamp, rank) {
        this.bidID = bidID;
        this.groupID = groupID;
        this.groupSize = groupSize;
        this.projectID = projectID;
        this.rank = rank;
        this.timestamp = timestamp;
    }
}


/*
Recursive function used to assign groups to projects
@param      {array}     projects    An array of project Objects as defined above
@param      {array}     groups      An array of group Objects as defined above
@return     {map}                   A map that where group ids point to a project id
*/
function groupPriorityAlgorithm(projects, groups) {
    var assignments = new Map([]);
    groupPriorityAlgorithm2(projects, groups, 1, assignments);
    return assignments;
}

/*
Recursive helper function used to assign groups to projects
@param      {array}     projects    An array of projects still remaining to be checked
@param      {array}     groups      An array of groups still remaining to be assigned
@param      {number}    rankNum     Num that keeps track of which ranking to check for during this loop
@param      {map}       assignments A map that where group ids point to a project id, which eventually be returned as the output
@return     {map}                   A map that where group ids point to a project id
*/
function groupPriorityAlgorithm2(projects, groups, rankNum, assignments) {
    //Ends the recursive function when there are either no groups left, no projects left, or when none of the groups have a bid left
    if (projects.length < 1 || groups.length < 1 || noBids(projects, groups)) {
        return assignments;
    }
    var projectIndexes = [];
    var groupIndexes = [];

    //Loops through the array of remaining projects
    for (var i = 0; i < projects.length; i++) {
        var bids = projects[i].bids;
        var currentRankBids = [];
        var totalStudents = 0;

        //This loops check for all the bids whose rank is equal to rankNum and whose group is still in the groups array
        for (var j = 0; j < bids.length; j++) {
            if (bids[j].rank == rankNum && checkGroup(groups, bids[j].groupID) == true) {
                currentRankBids.push(bids[j]);
                totalStudents += parseInt(bids[j].groupSize);
            }
        }


        //This if statement assigns all groups if the total size is less than or equal to the remaining project size
        if (totalStudents <= projects[i].remaining) {
            for (j = 0; j < currentRankBids.length; j++) {
                assignments.set(currentRankBids[j].groupID, projects[i].projectID);
                projects[i].decreaseRemaining(currentRankBids[j].groupSize);
                groupIndexes.push(currentRankBids[j].groupID);

            }
            if (projects[i].remaining == 0) {
                projectIndexes.push(projects[i]);

            }
        }



        //This else statement is for when the total size of groups is greater than the remaining size
        else {
            var biggestSize = projects[i].remaining;
            while (projects[i].remaining > 0 && biggestSize > 0) {
                var biggestGroups = [];
                for (j = 0; j < currentRankBids.length; j++) {
                    if (currentRankBids[j].groupSize == biggestSize) {
                        biggestGroups.push(currentRankBids[j]);
                    }
                }
                if (biggestGroups.length > 0) {
                    var assignedGroup = Number.MAX_SAFE_INTEGER;
                    for (j = 0; j < biggestGroups.length; j++) {
                        if (biggestGroups[j].timestamp < assignedGroup) {
                            assignedGroup = biggestGroups[j].groupID;
                        }
                    }
                    assignments.set(assignedGroup, projects[i].projectID);
                    projects[i].decreaseRemaining(biggestSize);
                    groupIndexes.push(assignedGroup);
                    biggestSize = projects[i].remaining;
                }

                else {
                    biggestSize--;
                }
            }
            if (projects[i].remaining == 0) {

                projectIndexes.push(projects[i].projectID);

            }
        }
        

    }

    //Constructs an array out of the remaining groups
    newGroups = new Array();
    for(var n=0; n<groups.length; n++) {
        if(groupIndexes.includes(groups[n].groupID) == false) {
            newGroups.push(groups[n]);
        }

    }
    groups = newGroups;

    //Constructs an array out of the remaining projects
    newProjects = new Array();
    for(var m=0; m<projects.length; m++) {
        if(projectIndexes.includes(projects[m].projectID) == false) {
            newProjects.push(projects[m]);
        }
    }
    projects = newProjects;
    
    rankNum++;

    groupPriorityAlgorithm2(projects, groups, rankNum, assignments);
}

/*
Checks whether the given group id is in the array of remaining groups
@param      {array}     groups      An array of group Objects
@param      {Number}    groupID     An integer value that represents a group ID
@return     {boolean}               Returns true if the group with the given id is in the array, false otherwise
*/
function checkGroup(groups, groupID) {
    for (var i = 0; i < groups.length; i++) {
        if (groups[i].groupID == groupID) {
            return true;
        }
    }
    return false;
}

/*
Given a project ID, returns the index of that project in the projects array 
@param      {array}     projects    An array of project Objects
@param      {Number}    projectID   An integer value that represents a group ID
@return     {Number}                Returns the index in the array if the project is in the array, returns -1 otherwise
*/
function projectIndex(projects, projectID) {
    for (i = 0; i < projects.length; i++) {
        if (projects[i].projectID == projectID) {
            return i;
        }
    }
    return -1;
}

/*
Given JSON data of groups, returns an array of each individual group size
@param      {JSON}      data        JSON data of all groups in the database
@return     {array}                 An array of the group size of each group
*/
function getGroupSize(data) {
    var group = JSON.parse(data);
    var groupSize = new Array(group.memberOne.length);

    for(var i=0; i<group.memberOne.length; i++) {
        var count = 0;
        if(group.leader[i] != null) {
            count++;
        }
        if(group.memberOne[i] != null) {
            count++;
        }
        if(group.memberTwo[i] != null) {
            count++;
        }
        if(group.memberThree[i] != null) {
            count++;
        }
        if(group.memberFour[i] != null) {
            count++;
        }
        if(group.memberFive[i] != null) {
            count++;
        }
        groupSize[i] = count;
    }
    return groupSize;
}

/*
Returns the index of the group with the given id in an array of groups
@param      {Number}    id      The id of a group
@param      {array}     group   An array of group Objects
@return                         Returns of the index of the group with the given id if exists, returns -1 otherwise
*/
function getGroup(id, group) {
    for(var i=0; i<group.groupID.length; i++) {
        if(parseInt(id) == parseInt(group.groupID[i])) {
            return i;
        }
    }

    return -1;
}

/*
Given a project ID, return an array of all bids related to that project
@param      {Number}    projectID       The id of a project
@param      {array}     allBids         The array containing all bids in the database
@param      {array}     group           The array of all groups in the database
@param      {array}     groupSize       The array of the group sizes of all groups
@return     {array}                     An array of all bids on a project   
*/
function getBids(projectID, allBids, group, groupSize) {
    var count = 0;
    for(var i=0; i<allBids.bidID.length; i++) {
        if(parseInt(projectID) == parseInt(allBids.projectID[i])) {
            count++;
        }
    }
    var bids = new Array(count);
    count = 0;
    for(var i=0; i<allBids.bidID.length; i++) {
        if(parseInt(projectID) == parseInt(allBids.projectID[i])) {
            bids[count] = new Bid(  parseInt(allBids.bidID[i]), parseInt(allBids.groupID[i]), parseInt(groupSize[getGroup(allBids.groupID[i], group)]), 
                                    parseInt(allBids.projectID[i]), new Date(allBids.timestamp[i]).getTime(), parseInt(allBids.priority[i]));
            count++;
        }
    }

    return bids;
}

/*
Returns false if any remaining group have a bids on any remaining project
@param      {array}     Projects        An array of remaining project Objects
@param      {array}     Groups          An array of remaining group Objects
@return     {boolean}                   Returns true if the remaining groups have no more bids on the remaining projects
*/
function noBids(Projects, Groups) {
    var noBids = true;
    for(var i=0; i<Projects.length; i++) {
        if(Projects[i].bids.length != 0) {
            for(var j=0; j<Projects[i].bids.length; j++) {
                var id = Projects[i].bids[j].groupID;
                for(var k=0; k<Groups.length; k++) {
                    if(parseInt(id) == parseInt(Groups[k].groupID)) {
                        return false;
                    }
                }
            }
        }
    }
    return noBids;
}


$(document).ready(function() {
    //Executes when the button with the id 'algorithm' is clicked
    $("#algorithm").click(function() {
        var groupSize = [];
        var group = [];
        var bid = [];
        var Groups = [];
        var Projects = [];
        var Users = [];
        var bidArray = [];
     
    //getGroupData is a php page that contains JSON data of all groups in the database    
    $.get('getGroupData', function(data) {
        group = JSON.parse(data);
        groupSize = getGroupSize(data);
        var groupArray = new Array(group.memberOne.length);
        //Constructs an array of Group Objects as defined in the Group Class
        for(var i = 0; i < group.memberOne.length; i++) {
            groupArray[i] = new Group(  parseInt(group.groupID[i]), group.leader[i], group.memberOne[i], group.memberTwo[i], group.memberThree[i], 
                                        group.memberFour[i], group.memberFive[i], parseInt(groupSize[i]));
        }
        Groups = groupArray;

    });

    //getBidData is a php page that contains JSON data of all bids in the database    
    $.get('getBidData', function(data) {
        bid = JSON.parse(data);
        var bidArray = new Array(bid.bidID.length);
        //Constructs an array of Bid Objects as defined in the Bid Class
        for(var i=0; i<bid.bidID.length; i++) {
            bidArray[i] = new Bid(  parseInt(bid.bidID[i]), parseInt(bid.groupID[i]), parseInt(groupSize[getGroup(bid.groupID[i], group)]), parseInt(bid.projectID[i]), 
                                    new Date(bid.timestamp[i]).getTime(), parseInt(bid.priority[i]));

        }
        
    });

    //getStudentData is a php page that contains JSON data of all student users in the database    
    $.get('getStudentData', function(data) {
        user = JSON.parse(data);
        var userArray = new Array();
        var count = 0;
        //The following loop assigns each userID an uniqueID in an array, the indexes of the array are the userIDs, while the data are the uniqueIDs
        for(var i=0; i<user.id.length; i++) {
            while(parseInt(user.id[i]) != count) {
                count++; 
            }
            userArray[count] = user.unique_id[i];
            count++;
        }
        Users = userArray;
    });

    //getProjectData is a php page that contains JSON data of all projects in the database    
    $.get('getProjectData', function(data) {
        var project = JSON.parse(data);
        var projectArray = new Array(project.projectID.length);
        //Constructs an array of Project Objects as defined in the Project Class
        for (var i=0; i<project.projectID.length; i++) {
            projectArray[i] = new Project(parseInt(project.projectID[i]), project.projectName[i], parseInt(project.maxSize[i]), project.projectDescription[i], 
                getBids(project.projectID[i], bid, group, groupSize));
        }
        Projects = projectArray;
        
        //Runs the assignment algorithm, which will return a map
        var assignment = groupPriorityAlgorithm(Projects, Groups);

        //Begins constructing the csv file
        var str = "Project Name, Member1, Member2, Member3, Member4, Member5, Member6, Member7, Member8\n";

        //Loops through array of all projects
        for(var i=0; i<Projects.length; i++) {
            str += Projects[i].projectName + ",";

            //Loops through array of all groups
            for(var j=0; j<Groups.length; j++) {
                //If the current group is assigned by the algorithm to the current project
                if(assignment.get(Groups[j].groupID) == Projects[i].projectID) {

                    //Goes through all possible members of the group and retrieve their unique ids
                    if(Groups[j].leader != null) {
                        if(Users[Groups[j].leader] != null) {
                            str += Users[Groups[j].leader] + ",";
                        }
                    }
                    if(Groups[j].member1 != null) {
                        if(Users[Groups[j].member1] != null) {
                            str += Users[Groups[j].member1] + ",";
                        }                    }
                    if(Groups[j].member2 != null) {
                        if(Users[Groups[j].member2] != null) {
                            str += Users[Groups[j].member2] + ",";
                        }                    }
                    if(Groups[j].member3 != null) {
                        if(Users[Groups[j].member3] != null) {
                            str += Users[Groups[j].member3] + ",";
                        }                    }
                    if(Groups[j].member4 != null) {
                        if(Users[Groups[j].member4] != null) {
                            str += Users[Groups[j].member4] + ",";
                        }                    }
                    if(Groups[j].member5 != null) {
                        if(Users[Groups[j].member5] != null) {
                            str += Users[Groups[j].member5] + ",";
                        }                    
                    }

                }
            }
            str += "\n";
        }

        //Downloads a csv file from the variable str
        var hiddenElement = document.createElement('a');
        hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(str);
        hiddenElement.target = '_blank';
        hiddenElement.download = 'CapstoneProjects.csv';
        hiddenElement.click();
    });


});
});

