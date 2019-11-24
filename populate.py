
#Recieves array of args
def insertTable(tableName, args, fds):
    line = "insert into " + tableName + " values ("
    c = 0

    for fields in args:
        if (c < (len(args) - 1)):
            line +=  fields + ", "
        else:
            line += fields + ");"
        c += 1

    fds.write(line)

def popLocalPublico(lat, longi, name, fds):
    insertTable("local_publico", [lat, longi, name], fds)
def popItem(identifier, desc, loc, lat, longi):

def main():

    sqlFile = open("populate.sql", "w")
    #populate all tables

    with open("coordinates.csv", "r") as coordinates: #random csv file on the internet
        for line in coordinates:
            data = line.split()
            popLocalPublico(data[1], data[2], ("'" + data[3] + "'"), sqlFile) #the "'" are needed for SQL















if __name__ == "__main__":
    main()
