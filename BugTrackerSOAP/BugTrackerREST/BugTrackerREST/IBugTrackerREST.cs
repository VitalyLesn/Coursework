using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;

namespace BugTrackerSOAP
{
    [ServiceContract]
    public interface IBugTrackerREST
    {

        [WebGet(UriTemplate = "/Departments")]
        [OperationContract]
        string SelectDepartments();

        [WebGet(UriTemplate = "/Departments,{name},{phone}")]
        [OperationContract]
        string InsertDepartmens(string name, string phone);

        [WebGet(UriTemplate = "/Departments,{id},{name},{phone}")]
        [OperationContract]
        string UpdateDepartmens(string id, string name, string phone);

        [WebGet(UriTemplate = "/Departments,{id}")]
        [OperationContract]
        string DeleteDepartmens(string id);

        [WebGet(UriTemplate = "/Bugs,{id}")]
        [OperationContract]
        string DeleteBugs(string id);

        [WebGet(UriTemplate = "/Bugs")]
        [OperationContract]
        string SelectBugs();

        [WebGet(UriTemplate = "/Bugs,{idproj},{infobug},{priority},{idempl},{status}")]
        [OperationContract]
        string InsertBugs(string idproj, string infobug, string priority, string idempl, string status);

        [WebGet(UriTemplate = "/Bugs,{idbug},{idproj},{infobug},{priority},{idempl},{status}")]
        [OperationContract]
        string UpdateBugs(string idbug, string idproj, string infobug, string priority, string idempl, string status);

        [WebGet(UriTemplate = "/Project")]
        [OperationContract]
        string SelectProject();

        [WebGet(UriTemplate = "/Project,{nameproj},{abbrevproj},{defenproj}")]
        [OperationContract]
        string InsertProject(string nameproj, string abbrevproj, string defenproj);

        [WebGet(UriTemplate = "/Project,{id},{nameproj},{abbrevproj},{defenproj}")]
        [OperationContract]
        string UpdateProject(string id, string nameproj, string abbrevproj, string defenproj);

        [WebGet(UriTemplate = "/Project,{id}")]
        [OperationContract]
        string DeleteProject(string id);

        [WebGet(UriTemplate = "/Employees")]
        [OperationContract]
        string SelectEmployees();

        [WebGet(UriTemplate = "/Employees,{fio},{login},{iddep},{position},{phoneempl},{email}")]
        [OperationContract]
        string InsertEmployees(string fio, string login, string iddep, string position, string phoneempl, string email);

        [WebGet(UriTemplate = "/Employees,{id},{fio},{login},{iddep},{position},{phoneempl},{email}")]
        [OperationContract]
        string UpdateEmployees(string id, string fio, string login, string iddep, string position, string phoneempl, string email);

        [WebGet(UriTemplate = "/Employees,{id}")]
        [OperationContract]
        string DeleteEmployees(string id);

    }
}
