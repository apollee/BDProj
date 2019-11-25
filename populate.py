import random
from datetime import datetime
import linecache

postgres_box_str = "( ( %d , %d ) , ( %d , %d ) )"
qualified_emails = []
def sqlBox(box):
    return postgres_box_str % (box[0][0] , box[0][1], box[1][0], box[1][1])

def insertTable(tableName, args, fds):
    line = "insert into " + tableName + " values ("
    c = 0

    for fields in args:
        if (c < (len(args) - 1)):
            line +=  fields + ", "
        else:
            line += fields + ");"
        c += 1
    fds.write(line + '\n')

def popLocalPublico(lat, longi, name, fds):
    insertTable("local_publico", [lat, longi, name], fds)


def popItem(identifier, desc, loc, lat, longi, fds):
    insertTable("item", ["DEFAULT", desc, loc, lat, longi], fds)
    if (identifier % 5) == 0:
        insertTable("duplicado", [ str(random.randint(1, identifier - 1)), str(identifier)], fds)

def popAnomalia(identifier, box, bytea , lingua, desc, tem_anom_red, fds):
    insertTable("anomalia", ["DEFAULT", sqlString(sqlBox(box)), sqlString("PLACEHOlDER FOR BYTEA"), sqlString(lingua), sqlString(desc), tem_anom_red], fds)

def popAnomaliaTrad(identifier, box, l2, fds):
    insertTable("anomalia_traducao", [str(identifier), sqlString(sqlBox(box)), sqlString(l2)], fds)

def popPropCorrecao(email, nro, timestamp, desc, fds):
    insertTable("proposta_de_correcao", [email, nro, timestamp, desc], fds)
def popUsers(email, password, nUsers, fds):
    insertTable('utilizador', [email, password], fds)
    if (nUsers % random.randint(1,10)) == 0: #add some randomness
        insertTable('utilizador_qualificado', [email], fds)
        qualified_emails.append(email)
    else:
        insertTable('utilizador_regular', [email], fds)

def popIncidencia(aID, iID, email, fds):
    insertTable('incidencia', [str(aID), str(iID), sqlString(email)], fds)

def popCorrecao(email, nro, aID, fds):
    insertTable('correcao', [email, nro, aID], fds)
def sqlString(string):
    return "'" + string + "'"


def main():

    sqlFile = open("populate.sql", "w")
    aID = []
    iID = []
    emails = []
    with open("coordinates.csv", "r") as coordinates: #random csv file on the internet
        counter = 1
        for line in coordinates:
            data = line.split()
            lat = data[1]
            longi = data[2]
            name = sqlString(data[3])
            popLocalPublico(lat, longi, name , sqlFile)
            if(counter % random.randint(1,3) == 0):
                popItem(counter, sqlString(str(linecache.getline('descriptions.txt', counter))[:-1]), name, lat, longi, sqlFile)
                iID.append(counter)
                counter+= 1
        sqlFile.write('\n')

    #populate Users
    with open("email_pass.txt", 'r') as users:
        nUsers = 1
        for line in users:
            data = line.split(",")
            data[1] = data[1][:-1] #remove \n
            popUsers(sqlString(data[0]), sqlString(data[1]), nUsers, sqlFile)
            emails.append(data[0])
            nUsers+=1
        sqlFile.write('\n')

    with open("languages.txt", 'r') as anomalias:
        languages = []
        for line in anomalias: #get some languages
            data = line.split()
            if len(data) > 1: #file not very well formated
                languages.append(data[1])

        with open("descriptions.txt" , 'r') as descriptions:
            counter = 1
            for desc in descriptions:
                lingua_1 = random.choice(languages)
                popAnomalia(str(counter), ((10, 10), (20, 20)), "", lingua_1,desc[:-1], "TRUE", sqlFile)
                aID.append(counter)
                if((counter % 6) == 0):
                    lingua_2 = random.choice(languages)
                    while(lingua_2 == lingua_1):
                        lingua_2 = random.choice(languages)
                    popAnomaliaTrad(str(counter), ((20 , 20) , (30, 30)), lingua_2, sqlFile)
                counter +=1

    #incidencias
    tempaID = aID
    presentaiD = []
    for aidentifier in aID:
        chosen = random.choice(tempaID)
        presentaiD.append(chosen)
        popIncidencia(chosen, random.choice(iID), random.choice(emails), sqlFile)
        tempaID.remove(chosen)

    counter = 1
    for email in qualified_emails:
        popPropCorrecao(email, str(counter), sqlString(str(datetime.now())), sqlString(str(linecache.getline('descriptions.txt', counter))[:-1]),sqlFile)
        popCorrecao(email, str(counter), str(random.choice(presentaiD)), sqlFile)

        counter += 1

if __name__ == "__main__":
    main()
